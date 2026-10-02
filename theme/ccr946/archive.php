<?php get_header(); ?>

<main id="page-content" class="site-main content">

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
                            <div class="thumb"></div>
                            <div class="body">
                                <span class="tag">Local News</span>
                                <h2>EU Election Debate comes to Claremorris</h2>
                                <div class="date">20 May 2024</div>
                                <p class="excerpt">
                                    Thirteen Midlands-North-West candidates faced questions at the McWilliam Park Hotel. Anthony
                                    McNicholas brings a special report on air tonight at 9pm.
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