<?php

/**
 * CCR 94.6 — Google Calendar → WordPress schedule sync
 *
 * Runs inside the ccr-new-web container.
 */

declare(strict_types=1);

date_default_timezone_set('Europe/Dublin');

require_once '/var/www/html/wp-load.php';

global $wpdb;

if ( $wpdb->query( "SET NAMES utf8mb4" ) === false ) {
    fwrite(
        STDERR,
        "ERROR: Could not set MySQL connection charset: "
        . $wpdb->last_error
        . PHP_EOL
    );
    exit(1);
}

$table = $wpdb->prefix . 'schedule';

$api_key = getenv('GOOGLE_CALENDAR_API_KEY');

if (!$api_key) {
    fwrite(STDERR, "ERROR: GOOGLE_CALENDAR_API_KEY is not set.\n");
    exit(1);
}

$calendar_id = 'marketing@claremorriscommunityradio.ie';

$timezone = new DateTimeZone('Europe/Dublin');

/*
 * Current week:
 * Monday 00:00 → next Monday 00:00
 */
$now = new DateTimeImmutable('now', $timezone);

$week_start = $now->modify('monday this week')->setTime(0, 0, 0);
$week_end   = $week_start->modify('+7 days');

$time_min = $week_start->format(DateTimeInterface::ATOM);
$time_max = $week_end->format(DateTimeInterface::ATOM);

echo "Syncing week: "
    . $week_start->format('Y-m-d')
    . " → "
    . $week_end->format('Y-m-d')
    . PHP_EOL;


/*
 * Create table if it does not exist.
 */
$charset_collate = $wpdb->get_charset_collate();

$sql = "
CREATE TABLE IF NOT EXISTS {$table} (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    google_event_id VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME DEFAULT NULL,
    title TEXT NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY google_event_id (google_event_id),
    KEY event_date (event_date),
    KEY event_date_start_time (event_date, start_time)
) {$charset_collate}
";

if ($wpdb->query($sql) === false) {
    fwrite(
        STDERR,
        "ERROR: Could not create/check schedule table: "
        . $wpdb->last_error
        . PHP_EOL
    );
    exit(1);
}


/*
 * Google Calendar API.
 */
$events = [];
$page_token = null;

do {

    $base_url =
    	'https://www.googleapis.com/calendar/v3/calendars/'
    	. rawurlencode($calendar_id)
    	. '/events';

	$query = http_build_query(
    	[
        	'singleEvents' => 'true',
        	'orderBy'      => 'startTime',
        	'timeMin'      => $time_min,
        	'timeMax'      => $time_max,
        	'maxResults'   => 2500,
    	],
    	'',
    	'&',
    	PHP_QUERY_RFC3986
	);
	
	$url = $base_url . '?' . $query;

    if ($page_token) {
    	$url .= '&' . http_build_query(
        	[
            	'pageToken' => $page_token,
        	],
        	'',
        	'&',
        	PHP_QUERY_RFC3986
    	);
	}

    $response = wp_remote_get(
        $url,
        [
            'timeout' => 20,
            'headers' => [
                'X-Goog-Api-Key' => $api_key,
            ],
        ]
    );

    /*
     * IMPORTANT:
     * If Google cannot be reached, do not touch the database.
     */
    if (is_wp_error($response)) {
        fwrite(
            STDERR,
            "ERROR: Google Calendar request failed: "
            . $response->get_error_message()
            . PHP_EOL
        );
        exit(1);
    }

    $status_code = wp_remote_retrieve_response_code($response);

    if ($status_code !== 200) {
        fwrite(
            STDERR,
            "ERROR: Google Calendar returned HTTP "
            . $status_code
            . PHP_EOL
        );

        $body = wp_remote_retrieve_body($response);

        if ($body) {
            fwrite(STDERR, $body . PHP_EOL);
        }

        exit(1);
    }

    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body, true);

    if (!is_array($data)) {
        fwrite(
            STDERR,
            "ERROR: Invalid JSON received from Google Calendar."
            . PHP_EOL
        );
        exit(1);
    }

    if (isset($data['error'])) {
        fwrite(
            STDERR,
            "ERROR: Google Calendar API error."
            . PHP_EOL
        );
        exit(1);
    }

    /*
     * Validate that Google returned an events collection.
     */
    if (!isset($data['items']) || !is_array($data['items'])) {
        fwrite(
            STDERR,
            "ERROR: Google Calendar response does not contain events."
            . PHP_EOL
        );
        exit(1);
    }

    foreach ($data['items'] as $event) {

        if (
            empty($event['id']) ||
            empty($event['start']['dateTime']) ||
            empty($event['end']['dateTime'])
        ) {
            /*
             * Skip all-day events and malformed events.
             */
            continue;
        }

        try {

            $start = new DateTimeImmutable(
                $event['start']['dateTime'],
                $timezone
            );

            $end = new DateTimeImmutable(
                $event['end']['dateTime'],
                $timezone
            );

        } catch (Exception $e) {

            fwrite(
                STDERR,
                "WARNING: Invalid event datetime, skipping event."
                . PHP_EOL
            );

            continue;
        }

        /*
         * Keep only events belonging to the requested week.
         */
        if ($start < $week_start || $start >= $week_end) {
            continue;
        }

        $events[] = [
            'google_event_id' => (string) $event['id'],
            'event_date'      => $start->format('Y-m-d'),
            'start_time'      => $start->format('H:i:s'),
            'end_time'        => $end->format('H:i:s'),
            'title' => trim(str_replace(' (r)', '', (string) ($event['summary'] ?? ''))),
        ];
    }

    $page_token = $data['nextPageToken'] ?? null;

} while ($page_token);


/*
 * We now have a complete and successfully validated
 * Google Calendar response.
 *
 * Only NOW do we modify the database.
 */
echo "Events received: " . count($events) . PHP_EOL;


/*
 * Start transaction.
 */
$wpdb->query('START TRANSACTION');


try {

    /*
     * Remove the existing schedule for this week.
     */
    $deleted = $wpdb->query(
        $wpdb->prepare(
            "
            DELETE FROM {$table}
            WHERE event_date >= %s
              AND event_date < %s
            ",
            $week_start->format('Y-m-d'),
            $week_end->format('Y-m-d')
        )
    );

    if ($deleted === false) {
        throw new RuntimeException(
            'Could not delete existing schedule: '
            . $wpdb->last_error
        );
    }


    /*
     * Insert fresh events.
     */
    $updated_at = current_time('mysql');

    foreach ($events as $event) {

        $result = $wpdb->insert(
            $table,
            [
                'google_event_id' => $event['google_event_id'],
                'event_date'      => $event['event_date'],
                'start_time'      => $event['start_time'],
                'end_time'        => $event['end_time'],
                'title'           => $event['title'],
                'updated_at'      => $updated_at,
            ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );

        if ($result === false) {
            throw new RuntimeException(
                'Could not insert event: '
                . $wpdb->last_error
            );
        }
    }


    /*
     * Everything succeeded.
     */
    $commit_result = $wpdb->query('COMMIT');

	if ($commit_result === false) {
    	throw new RuntimeException(
        	'Could not commit transaction: '
        	. $wpdb->last_error
    	);
	}

} catch (Throwable $e) {

    /*
     * Something went wrong:
     * restore the previous week's data.
     */
    $wpdb->query('ROLLBACK');

    fwrite(
        STDERR,
        "ERROR: Database sync failed: "
        . $e->getMessage()
        . PHP_EOL
    );

    exit(1);
}


echo "Deleted old events: " . $deleted . PHP_EOL;
echo "Inserted new events: " . count($events) . PHP_EOL;
echo "Sync completed successfully." . PHP_EOL;

