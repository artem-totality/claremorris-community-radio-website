<?php get_header(); ?>

<main id="page-content" class="site-main content">
    <?php

    global $wpdb;

    $table_name = $wpdb->prefix . 'schedule';

    $today = current_time( 'Y-m-d' );
    $last_day = date(
        'Y-m-d',
        strtotime( $today . ' +6 days' )
    );

    $events = $wpdb->get_results(
        $wpdb->prepare(
            "
            SELECT
                event_date,
                start_time,
                end_time,
                title
            FROM {$table_name}
            WHERE event_date BETWEEN %s AND %s
            ORDER BY event_date ASC, start_time ASC
            ",
            $today,
            $last_day
        )
    );

    /*
    * Group events by date.
    */
    $schedule = array();

    foreach ( $events as $event ) {
        $schedule[ $event->event_date ][] = $event;
    }

    /*
    * Build 7 days: today + next 6 days.
    */
    $days = array();

    for ( $i = 0; $i < 7; $i++ ) {

        $date = date(
            'Y-m-d',
            strtotime( $today . " +{$i} days" )
        );

        $days[] = array(
            'date'      => $date,
            'timestamp' => strtotime( $date ),
            'events'    => isset( $schedule[ $date ] )
                ? $schedule[ $date ]
                : array(),
        );
    }

    ?>

    <section class="page-head">
        <div class="container">
            <span class="eyebrow">This Week</span>
            <h1>Weekly Schedule</h1>
            <p>What's on 94.6FM, day by day.</p>
        </div>
    </section>

    <section class="schedule-section">

        <div class="schedule-section__inner">

            <div class="container">

                <div
                    class="day-tabs"
                    role="tablist"
                    aria-label="Day of the week"
                >

                    <?php foreach ( $days as $index => $day ) : ?>

                        <?php
                        $date_key = $day['date'];
                        $is_today = ( $date_key === $today );
                        ?>

                        <button
                            class="day-tabs__tab<?php echo $is_today ? ' day-tabs__tab--active' : ''; ?>"
                            data-day="<?php echo esc_attr( $date_key ); ?>"
                            role="tab"
                            aria-controls="schedule-<?php echo esc_attr( $date_key ); ?>"
                            aria-selected="<?php echo $is_today ? 'true' : 'false'; ?>"
                        >

                            <div class="day-top">
                                <span class="full">
                                    <?php echo esc_html(
                                        wp_date( 'j F', $day['timestamp'] )
                                    ); ?>
                                </span>
                            
                                <span class="day">
                                    <?php echo esc_html(
                                        wp_date( 'D', $day['timestamp'] )
                                    ); ?>
                                </span>
                            </div>
                            <span
                                class="today-dot"
                                <?php echo $is_today ? '' : 'hidden'; ?>
                            ></span>

                        </button>

                    <?php endforeach; ?>

                </div>

            </div>


            <div class="container container--narrow">

                <?php foreach ( $days as $index => $day ) : ?>

                    <?php
                    $date_key = $day['date'];
                    $is_today = ( $date_key === $today );
                    ?>

                    <div
                        class="day-panel<?php echo $is_today ? ' day-panel--active' : ''; ?>"
                        data-panel="<?php echo esc_attr( $date_key ); ?>"
                        id="schedule-<?php echo esc_attr( $date_key ); ?>"
                        role="tabpanel"
                    >

                        <h2>
                            <?php echo esc_html(
                                wp_date( 'l', $day['timestamp'] )
                            ); ?>
                        </h2>


                        <div class="schedule-list">

                            <?php if ( ! empty( $day['events'] ) ) : ?>

                                <?php foreach ( $day['events'] as $event ) : ?>

                                    <div class="schedule-item">

                                        <div class="time">
                                            <?php echo esc_html( substr( $event->start_time, 0, 5 ) ); ?>
                                        </div>

                                        <div class="swatch"></div>

                                        <div class="info">

                                            <h3>
                                                <?php echo esc_html( $event->title ); ?>
                                            </h3>

                                            <?php if ( ! empty( $event->end_time ) ) : ?>

                                                <div class="host">
                                                    -- until
                                                    <?php echo esc_html( substr( $event->end_time, 0, 5 ) ); ?>
                                                </div>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <div class="schedule-item schedule-item--empty">

                                    <div class="info">
                                        <h3>No confirmed programmes</h3>
                                        <div class="host">
                                            This day is currently open for specials,
                                            community programming and new shows.
                                        </div>
                                    </div>

                                </div>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>


                <p class="schedule-note">
                    Confirmed slots shown above; the rest of each day is kept open
                    for specials, community programming and new shows.
                    Get in touch on
                    <a href="tel:0873262007">087 326 2007</a>
                    if you'd like to present.
                </p>


                <p class="schedule-note">
                    See the full program schedule
                    <a
                        href="https://www.google.com/calendar/embed?title=Schedule%20Claremorris%20Community%20Radio&mode=AGENDA&wkst=1&bgcolor=%23FFFFFF&src=marketing%40claremorriscommunityradio.ie&color=%23182C57&ctz=Europe%2FDublin"
                        target="_blank"
                        rel="noopener"
                    >here</a>.
                </p>

            </div>

        </div>

    </section>
</main>

<?php get_footer(); ?>