<?php get_header(); ?>

<main id="page-content" class="site-main content">
        <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class(); ?>>
                <div class="container">
                    <h1>
                        <?php the_title(); ?>
                    </h1>

                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; ?>
</main>

<?php get_footer(); ?>
