<footer class="footer" id="about">

    <div class="container">
        <div class="footer__inner">
            <div class="footer__main">
                <div class="footer__info">
                    <p>
                        This project is supported by the
                        <a
                            href="https://www.gov.ie/en/organisation/department-of-rural-and-community-development/"
                            target="_blank"
                            rel="noopener"
                            >Department of Rural and Community Development</a
                        >, and <a href="https://www.pobal.ie" target="_blank" rel="noopener">Pobal</a> through the Community
                        Services Programme.
                    </p>
                    <p>
                        Claremorris Community Radio is a company limited by guarantee without share capital, and is a
                        registered charity in Ireland.
                    </p>
                    <p class="reg">
                        Charity Registration Number: <strong>20166311</strong><br />Company Number: <strong>388562</strong>
                    </p>
                </div>
                <div class="footer__divider"></div>
                <?php
                $facebook_url  = get_theme_mod( 'ccr946_facebook_url' );
                $instagram_url = get_theme_mod( 'ccr946_instagram_url' );
                $x_url         = get_theme_mod( 'ccr946_x_url' );
                ?>
                <div class="footer__social">
                    <h3>Social Media</h3>
                    <div class="icons">
                        <?php if ( $facebook_url ) : ?>

                            <a href="<?php echo esc_url( $facebook_url ); ?>"
                            target="_blank"
                            rel="noopener"
                            aria-label="Facebook">

                                <svg viewBox="0 0 24 24" fill="currentColor">

                                    <path
                                        d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.45 2.89h-2.33v6.99A10 10 0 0 0 22 12z"
                                    />

                                </svg>

                            </a>

                        <?php endif; ?>
                        <?php if ( $instagram_url ) : ?>

                            <a href="<?php echo esc_url( $instagram_url ); ?>"
                            target="_blank"
                            rel="noopener"
                            aria-label="Instagram">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                    <rect x="2" y="2" width="20" height="20" rx="5" />

                                    <circle cx="12" cy="12" r="4" />

                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />

                                </svg>

                            </a>

                        <?php endif; ?>
                        <?php if ( $x_url ) : ?>

                            <a href="<?php echo esc_url( $x_url ); ?>"
                            target="_blank"
                            rel="noopener"
                            aria-label="Twitter / X">

                                <svg viewBox="0 0 24 24" fill="currentColor">

                                    <path
                                        d="M18.9 2H22l-7.6 8.7L23 22h-6.9l-5.4-6.6L4.4 22H1.3l8.1-9.3L1 2h7.1l4.9 6.1L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"
                                    />

                                </svg>

                            </a>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__text">
                    &copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
                    <?php bloginfo( 'name' ); ?>
                    · 94.6 FM · Claremorris, Co. Mayo, Ireland
                </div>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>

</div><!-- .wrapper -->

</body>

</html>
