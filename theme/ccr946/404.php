<?php get_header(); ?>

<main class="site-main">

    <div class="site-container">

        <h1>Page not found</h1>

        <p>
            Sorry, the page you are looking for does not exist.
        </p>

        <p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                Return to the homepage
            </a>
        </p>

    </div>

</main>

<?php get_footer(); ?>
