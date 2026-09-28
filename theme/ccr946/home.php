<?php get_header(); ?>

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
                <span class="eyebrow">Local News</span>
                <h1>News</h1>
                <p>Updates, events and reports from Claremorris Community Radio and the wider community.</p>
            </div>
        </div>
    </section>

    <section class="news-section">
        <div class="container container--narrow">
            <div class="news-section__inner">
                <div class="news-list">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <a class="news-list__row" href="<?php the_permalink(); ?>">
                            <div class="thumb">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="body">
                                <span class="tag"><?php
                                    $categories = get_the_category();

                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name );
                                    }
                                    ?>
                                </span>
                                <h2><?php the_title(); ?></h2>
                                <div class="date">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </div>
                                <p class="excerpt">
                                    <?php echo esc_html( get_the_excerpt() ); ?>
                                </p>
                            </div>
                        </a>

                    <?php endwhile; ?>

                </div>

                <nav class="pagination" aria-label="News pagination">
                    <a class="page-btn" href="#" aria-disabled="true" aria-label="Previous page">‹</a>
                    <a class="page-btn current" href="#" aria-current="page">1</a>
                    <a class="page-btn" href="#">2</a>
                    <a class="page-btn" href="#">3</a>
                    <a class="page-btn" href="#">4</a>
                    <span class="page-btn ellipsis">…</span>
                    <a class="page-btn" href="#">8</a>
                    <a class="page-btn" href="#" aria-label="Next page">›</a>
                </nav>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>