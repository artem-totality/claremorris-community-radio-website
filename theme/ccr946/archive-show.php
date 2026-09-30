<?php get_header(); ?>

<main class="site-main content">

    <section class="page-head">

        <div class="container">

            <div class="page-head__inner">

                <span class="eyebrow">Weekly Line-up</span>

                <h1>All Shows</h1>

                <p>
                    Every programme on 94.6FM, day by day. Tap a show for the host,
                    schedule and how to get in touch while it's on air.
                </p>

            </div>

        </div>

    </section>

    <section class="shows-section">

        <div class="container container--narrow">

            <div class="shows-section__inner">

                <?php
                /*
                 * Get all Shows.
                 */
                $shows_query = new WP_Query(
                    [
                        'post_type'      => 'show',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                    ]
                );

                /*
                 * Weekdays in the order we want to display them.
                 */
                $weekdays = [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday',
                ];

                /*
                 * Prepare empty groups.
                 */
                $shows_by_day = [];

                foreach ( $weekdays as $day ) {
                    $shows_by_day[ $day ] = [];
                }

                /*
                 * Put each Show into its selected day(s).
                 */
                if ( $shows_query->have_posts() ) :

                    while ( $shows_query->have_posts() ) :
                        $shows_query->the_post();

                        $days = get_field( 'on_air_day' );
                        $start = get_field( 'on_air_start' );

                        if ( ! is_array( $days ) ) {
                            $days = $days ? [ $days ] : [];
                        }

                        foreach ( $days as $day ) {

                            if ( isset( $shows_by_day[ $day ] ) ) {
                                $shows_by_day[ $day ][] = [
                                    'post_id' => get_the_ID(),
                                    'start'   => $start,
                                ];
                            }
                        }

                    endwhile;

                    wp_reset_postdata();

                endif;

                /*
                 * Sort each day by start time.
                 */
                foreach ( $shows_by_day as $day => &$shows ) {

                    usort(
                        $shows,
                        function ( $a, $b ) {
                            return strcmp( $a['start'] ?? '', $b['start'] ?? '' );
                        }
                    );

                }

                unset( $shows );
                ?>

                <?php foreach ( $shows_by_day as $day => $shows ) : ?>

                    <?php if ( empty( $shows ) ) : ?>
                        <?php continue; ?>
                    <?php endif; ?>

                    <div class="day-group">

                        <h2><?php echo esc_html( $day ); ?></h2>

                        <div class="shows-section__list">

                            <?php foreach ( $shows as $show ) : ?>

                                <?php
                                $post_id = $show['post_id'];

                                $title = get_the_title( $post_id );
                                $url   = get_permalink( $post_id );

                                $host_name = get_field( 'host_name', $post_id );
                                $start     = get_field( 'on_air_start', $post_id );
                                $end       = get_field( 'on_air_end', $post_id );

                                $start_time = $start
                                    ? date( 'H:i', strtotime( $start ) )
                                    : '';

                                $days_for_show = get_field( 'on_air_day', $post_id );

                                if ( ! is_array( $days_for_show ) ) {
                                    $days_for_show = $days_for_show
                                        ? [ $days_for_show ]
                                        : [];
                                }

                                $day_labels = [];

                                foreach ( $days_for_show as $show_day ) {
                                    $day_labels[] = substr( $show_day, 0, 3 );
                                }

                                $day_text = implode( '–', $day_labels );
                                ?>

                                <a
                                    class="shows-section__row"
                                    href="<?php echo esc_url( $url ); ?>"
                                >

                                    <?php if ( has_post_thumbnail( $post_id ) ) : ?>

                                        <div class="swatch">
                                            <?php
                                            echo get_the_post_thumbnail(
                                                $post_id,
                                                'thumbnail',
                                                [
                                                    'alt' => $title,
                                                ]
                                            );
                                            ?>
                                        </div>

                                    <?php else : ?>

                                        <div class="swatch"></div>

                                    <?php endif; ?>

                                    <div class="info">

                                        <h3>
                                            <?php echo esc_html( $title ); ?>
                                        </h3>

                                        <?php if ( $host_name ) : ?>
                                            <div class="host">
                                                With <?php echo esc_html( $host_name ); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="time">

                                        <?php if ( $start_time ) : ?>
                                            <strong>
                                                <?php echo esc_html( $start_time ); ?>
                                            </strong>
                                        <?php endif; ?>

                                        <?php echo esc_html( $day_text ); ?>

                                    </div>

                                    <div class="chevron">→</div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>