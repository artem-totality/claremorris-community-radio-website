<?php get_header(); ?>

<main class="site-main">

    <div class="site-container">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article <?php post_class(); ?>>

                    <h1>
                        <?php the_title(); ?>
                    </h1>

                    <?php the_content(); ?>

                </article>

            <?php endwhile; ?>

        <?php else : ?>

            <p>No content found.</p>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>
