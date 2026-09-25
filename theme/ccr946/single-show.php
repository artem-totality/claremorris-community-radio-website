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

    <section class="show-hero">

        <div class="container">

            <div class="show-hero__inner">

                <img
                    class="show-hero__cover"
                    src="..."
                    alt="Serendipity show cover artwork"
                    role="img"
                />

                <div class="show-hero__title-block">

                    <span class="show-hero__eyebrow">
                        Music &amp; Talk
                    </span>

                    <h1>Serendipity</h1>

                    <div class="show-hero__meta">

                        <div class="meta-card">
                            <div class="label">On Air</div>
                            <div class="value">Thursdays, 17:00</div>
                            <div class="sub">5:00pm — 6:00pm</div>
                        </div>

                        <div class="meta-card">
                            <div class="label">Host</div>
                            <div class="value">Niamh O'Kelly</div>
                            <div class="sub">Presenter</div>
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

                        <p>
                            Serendipity is a relaxed hour of music, chat and
                            unexpected discoveries, hosted by Niamh O'Kelly
                            every Thursday evening.
                        </p>

                    </div>

                    <div class="show-body__section">

                        <h2>Host</h2>

                        <div class="host-card">

                            <div class="host-card__avatar">NO</div>

                            <div>
                                <div class="host-card__name">
                                    Niamh O'Kelly
                                </div>

                                <div class="host-card__role">
                                    Presenter, Serendipity
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
                        href="sms:0873262007"
                    >
                        <span class="sidebar-card__sms-icon"></span>
                        087 326 2007
                    </a>

                </aside>

            </div>

        </div>

    </section>

</main>

<?php
get_footer();