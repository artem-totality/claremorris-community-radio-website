<?php get_header(); ?>

<main id="page-content" class="site-main content">

    <section class="notfound">
        <div class="container">
            <div class="notfound__inner">
                <span class="onair-badge"><span class="off-dot"></span>OFF AIR — SIGNAL LOST</span>

                <div class="dial">
                    <div class="dial__screen">
                        <div class="dial__freq">404<span>FM</span></div>
                        <div class="dial__status">NO STATION FOUND AT THIS FREQUENCY</div>
                    </div>
                    <div class="dial__scale">
                        <svg viewBox="0 0 500 60" preserveAspectRatio="xMidYMid meet">
                            <g class="ticks">
                                <line x1="10" y1="10" x2="10" y2="24" class="major" />
                                <line x1="60" y1="10" x2="60" y2="20" />
                                <line x1="110" y1="10" x2="110" y2="20" />
                                <line x1="160" y1="10" x2="160" y2="24" class="major" />
                                <line x1="210" y1="10" x2="210" y2="20" />
                                <line x1="260" y1="10" x2="260" y2="20" />
                                <line x1="310" y1="10" x2="310" y2="24" class="major" />
                                <line x1="360" y1="10" x2="360" y2="20" />
                                <line x1="410" y1="10" x2="410" y2="20" />
                                <line x1="460" y1="10" x2="460" y2="24" class="major" />
                                <line x1="490" y1="10" x2="490" y2="20" />
                            </g>
                            <g class="labels">
                                <text x="10" y="38" text-anchor="middle">88</text>
                                <text x="160" y="38" text-anchor="middle">94.6</text>
                                <text x="310" y="38" text-anchor="middle">101</text>
                                <text x="460" y="38" text-anchor="middle">108</text>
                            </g>
                            <line class="dial__needle" x1="160" y1="4" x2="160" y2="30" />
                        </svg>
                    </div>
                </div>

                <h1>You've Drifted Off Frequency</h1>
                <p class="notfound__lead">
                    The page you were looking for isn't broadcasting here. It may have moved, been taken off the schedule,
                    or never existed in the first place. Let's get you tuned back to <strong>94.6FM</strong>.
                </p>

                <div class="notfound__actions">
                    <a class="notfound__btn primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"> <span>▶</span> Back to Home </a>
                    <a class="notfound__btn secondary" href="<?php echo esc_url( get_post_type_archive_link( 'show' ) ); ?>">Browse Shows</a>
                </div>

                <div class="equalizer" aria-hidden="true">
                    <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
