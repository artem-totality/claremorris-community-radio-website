<?php get_header(); ?>

<main class="site-main">

    <div class="site-container">

        <?php if ( have_posts() ) : ?>

            <header class="archive-header">

                <h1>
                    <?php the_archive_title(); ?>
                </h1>

                <?php the_archive_description(); ?>

            </header>

            <?php while ( have_posts() ) : the_post(); ?>

                <article <?php post_class(); ?>>

                    <h2>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <?php the_excerpt(); ?>

                </article>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>

            <p>No posts found.</p>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>
