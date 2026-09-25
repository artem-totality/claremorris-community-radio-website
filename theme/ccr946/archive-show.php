<?php
get_header();
?>

<main class="site-main content">

    <div class="breadcrumb">
        <div class="container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            /
            <a href="<?php echo esc_url( home_url( '/#shows' ) ); ?>">Shows</a>
            /
            Serendipity
        </div>
    </div>
    
    <section class="page-head">
        <div class="container">
            <div class="page-head__inner">
                <span class="eyebrow">Weekly Line-up</span>
                <h1>All Shows</h1>
                <p>
                    Every programme on 94.6FM, day by day. Tap a show for the host, schedule and how to get in touch while
                    it's on air.
                </p>
            </div>
        </div>
    </section>

    <section class="shows-section">
        <div class="container">
            <div class="shows-section__inner">
                <div class="day-group">
                    <h2>Weekdays</h2>
                    <div class="shows-section__list">
                        <a class="shows-section__row" href="ccr946-show.html">
                            <div class="swatch"></div>
                            <div class="info">
                                <h3>Good Morning Show</h3>
                                <div class="host">With the CCR breakfast team</div>
                            </div>
                            <div class="time"><strong>09:00</strong>Mon–Fri</div>
                            <div class="chevron">→</div>
                        </a>
                        <a class="shows-section__row" href="ccr946-show.html">
                            <div class="swatch"></div>
                            <div class="info">
                                <h3>Midday Mix</h3>
                                <div class="host">Music through the afternoon</div>
                            </div>
                            <div class="time"><strong>11:00</strong>Mon–Fri</div>
                            <div class="chevron">→</div>
                        </a>
                    </div>
                </div>

                <div class="day-group">
                    <h2>Thursday</h2>
                    <div class="shows-section__list">
                        <a class="shows-section__row" href="ccr946-show.html">
                            <div class="swatch"></div>
                            <div class="info">
                                <h3>Serendipity</h3>
                                <div class="host">With Niamh O'Kelly</div>
                            </div>
                            <div class="time"><strong>17:00</strong>Thursdays</div>
                            <div class="chevron">→</div>
                        </a>
                    </div>
                </div>

                <div class="day-group">
                    <h2>Sunday</h2>
                    <div class="shows-section__list">
                        <a class="shows-section__row" href="ccr946-show.html">
                            <div class="swatch"></div>
                            <div class="info">
                                <h3>Sentimental Journey</h3>
                                <div class="host">With Niamh O'Kelly</div>
                            </div>
                            <div class="time"><strong>17:00</strong>Sundays</div>
                            <div class="chevron">→</div>
                        </a>
                    </div>
                </div>

                <div class="day-group">
                    <h2>Specials</h2>
                    <div class="shows-section__list">
                        <a class="shows-section__row" href="ccr946-show.html">
                            <div class="swatch"></div>
                            <div class="info">
                                <h3>EU Debate Report</h3>
                                <div class="host">With Anthony McNicholas</div>
                            </div>
                            <div class="time"><strong>21:00</strong>One-off</div>
                            <div class="chevron">→</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();