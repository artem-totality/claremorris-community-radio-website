<?php get_header(); ?>

<main id="page-content" class="site-main content"> 

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="breadcrumb">
                <div class="container">
                    <button id="back-button">< Back</button>
                    /
                    <?php the_title(); ?>
                </div>
            </div>

            <article <?php post_class(); ?>>
                <div class="news-article">
                    <div class="container container--narrow">
                        <div class="news-article__head">
                            <span class="news-article__tag">
                                <?php
                                $categories = get_the_category();

                                if ( ! empty( $categories ) ) {
                                    echo esc_html( $categories[0]->name );
                                }
                                ?>
                            </span>
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                            <div class="news-article__date">Published <time datetime="2024-05-20"><?php echo esc_html( get_the_date() ); ?></time></div>
                        </div>

                        <div class="news-article__body">
                            <?php the_content(); ?> 
                        </div>
                    </div>
                </div>

            </article>

        <?php endwhile; ?>

</main>

<?php get_footer(); ?>
