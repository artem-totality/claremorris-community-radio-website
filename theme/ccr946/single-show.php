<?php get_header(); ?>


<main id="page-content" class="site-main content">

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

                <div class="breadcrumb">
                    <div class="container">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                        /
                        <a href="<?php echo esc_url( home_url( '/#shows' ) ); ?>">Shows</a>
                        /
                        Serendipity
                    </div>
                </div>

                <section class="show-hero">

                    <div class="container">

                        <div class="show-hero__inner">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail(
                                    'large',
                                    [
                                        'class' => 'show-hero__cover',
                                        'alt'   => get_the_title() . ' show cover artwork',
                                    ]
                                ); ?>
                            <?php else : ?>

                                <div class="show-hero__cover"></div>

                            <?php endif; ?>

                            <div class="show-hero__title-block">

                                <span class="show-hero__eyebrow">
                                    <?php the_field( 'genre' ); ?>
                                </span>

                                <h1><?php the_title(); ?></h1>

                                <div class="show-hero__meta">

                                    <div class="meta-card">
                                        <div class="label">On Air</div>
                                        <div class="value">
                                            <?php
                                            $days = get_field( 'on_air_day' );

                                            if ( $days ) {
                                                $day_names = array_map(
                                                    function ( $day ) {
                                                        return $day . 's';
                                                    },
                                                    $days
                                                );

                                                echo esc_html( implode( ', ', $day_names ) );
                                            }
                                            ?>, <?php the_field( 'on_air_start' ); ?>
                                        </div>
                                        <div class="sub"><?php
                                                $start = get_field( 'on_air_start' );
                                                echo date( 'g:ia', strtotime( $start ) );
                                                ?> — <?php
                                                $start = get_field( 'on_air_end' );
                                                echo date( 'g:ia', strtotime( $start ) );
                                                ?></div>
                                    </div>

                                    <div class="meta-card">
                                        <div class="label">Host</div>
                                        <div class="value"><?php the_field( 'host_name' ); ?></div>
                                        <div class="sub"><?php the_field( 'host_role' ); ?></div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="show-body">

                    <div class="container">

                        <div class="show-body__inner">

                            <div class="show-body__main">

                                <div class="show-body__section">

                                    <h2>About</h2>

                                    <?php the_content(); ?>

                                </div>

                                <div class="show-body__section">

                                    <h2>Host</h2>

                                    <div class="host-card">

                                        <div class="host-card__avatar">
                                            <?php
                                            $host_avatar = get_field( 'host_avatar' );

                                            if ( $host_avatar ) :
                                            ?>
                                                <img
                                                    class="host-card__avatar"
                                                    src="<?php echo esc_url( $host_avatar ); ?>"
                                                    alt="<?php echo esc_attr( get_field( 'host_name' ) ); ?>"
                                                >
                                            <?php endif; ?>
                                        </div>

                                        <div>
                                            <div class="host-card__name">
                                                <?php the_field( 'host_name' ); ?>
                                            </div>

                                            <div class="host-card__role">
                                                <?php the_field( 'host_role' ); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <aside class="sidebar-card">

                                <h2>Contact the show</h2>

                                <p>
                                    You can contact the radio station's via text on
                                    087 326 2007.
                                </p>

                                <a
                                    class="sidebar-card__contact-number"
                                    href="tel:0873262007"
                                >
                                    <span class="sidebar-card__sms-icon"></span>
                                    087 326 2007
                                </a>

                            </aside>

                        </div>

                    </div>

                </section>

        <?php endwhile; ?>
    <?php endif; ?>

</main>
<?php get_footer(); ?>