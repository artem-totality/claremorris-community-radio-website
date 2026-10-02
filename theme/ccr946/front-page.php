<?php get_header(); ?>

<main id="page-content" class="site-main content">

	<section class="hero">
		<div class="container">
			<div class="hero__inner">
				<span class="hero__eyebrow">Broadcasting from Claremorris, Co. Mayo</span>
				<h1 class="hero__header">
					Claremorris Community Radio
					<span>Local voices, local stories — on air every day.</span>
				</h1>
				<button class="listen-live">
					<span class="listen-live__play"></span>
					<span class="label">Listen Live</span>
					<span class="listen-live__dot"></span>
				</button>

				<div class="now-playing">
					<div class="now-playing__label">Now Playing</div>
					<hr />
					<div class="now-playing__track"><span class="now-playing__artist" id="hero-track"></span> </div>
				</div>
			</div>
		</div>
	</section>

	<section class="onair">
		<div class="container">
			<div class="onair__inner">
				<div class="onair__col">
					<div class="tag">On Air Now</div>
					<div class="time" id="onair-time">09:00 — 11:00</div>
					<div class="show" id="onair-track">Good Morning Show</div>
				</div>
				<div class="onair__divider"></div>
				<div class="onair__col">
					<div class="tag">Next</div>
					<div class="time" id="next-time">11:00</div>
					<div class="show" id="next-track">Midday Mix</div>
				</div>
			</div>
		</div>
	</section>

	<section class="block news" id="news">
		<div class="container">
			<div class="block__inner">

				<div class="block-head">
					<h2>Latest News</h2>
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
						View all news
					</a>
				</div>

				<?php
				$latest_news = new WP_Query(
					array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
					)
				);
				?>

				<?php if ( $latest_news->have_posts() ) : ?>

					<div class="news__grid">

						<?php while ( $latest_news->have_posts() ) : $latest_news->the_post(); ?>

							<article class="news-card">

								<a href="<?php the_permalink(); ?>" class="news-card__link">

									<div class="news-card__thumb">

										<?php if ( has_post_thumbnail() ) : ?>

											<?php the_post_thumbnail( 'medium' ); ?>

										<?php endif; ?>

									</div>

									<div class="news-card__body">

										<div class="news-card__date">
											<?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
										</div>

										<h3><?php the_title(); ?></h3>

										<p>
											<?php echo esc_html( get_the_excerpt() ); ?>
										</p>

									</div>

								</a>

							</article>

						<?php endwhile; ?>

					</div>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>
		</div>
	</section>

	<?php
	$shows_query = new WP_Query(
		[
			'post_type'      => 'show',
			'posts_per_page' => 4,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
		]
	);
	?>

	<section class="block block--alt shows" id="shows">

		<div class="container">

			<div class="shows__inner">

				<div class="block-head">
					<h2>Our Shows</h2>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'show' ) ); ?>">
						Full schedule
					</a>
				</div>

				<div class="shows__grid">

					<?php if ( $shows_query->have_posts() ) : ?>

						<?php while ( $shows_query->have_posts() ) : $shows_query->the_post(); ?>

							<?php
							$show_id   = get_the_ID();
							$host_name = get_field( 'host_name', $show_id );
							$days      = get_field( 'on_air_day', $show_id );
							$start     = get_field( 'on_air_start', $show_id );
							$end       = get_field( 'on_air_end', $show_id );

							if ( ! is_array( $days ) ) {
								$days = $days ? [ $days ] : [];
							}

							$day_labels = [];

							foreach ( $days as $day ) {
								$day_labels[] = strtoupper( substr( $day, 0, 3 ) );
							}

							$day_text = implode( '–', $day_labels );

							$start_time = $start
								? date( 'H:i', strtotime( $start ) )
								: '';

							$end_time = $end
								? date( 'H:i', strtotime( $end ) )
								: '';
							?>

							<a class="show-card" href="<?php the_permalink(); ?>">
								<div class="show-card__thumb">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail('medium'); ?>
									<?php endif; ?>
								</div>
								<div class="show-card__swatch">
										<?php
										echo esc_html(
											$day_text . ( $start_time ? ' · ' . $start_time : '' )
										);
										?>
								</div>

								<h3><?php the_title(); ?></h3>

								<div class="show-card__when">

									<?php if ( $days ) : ?>
										<?php echo esc_html( implode( ', ', $days ) ); ?>
									<?php endif; ?>

									<?php if ( $start_time ) : ?>
										<?php echo esc_html( $start_time ); ?>
									<?php endif; ?>

									<?php if ( $end_time ) : ?>
										— <?php echo esc_html( $end_time ); ?>
									<?php endif; ?>

									<?php if ( $host_name ) : ?>
										with <?php echo esc_html( $host_name ); ?>
									<?php endif; ?>

								</div>

							</a>

						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

					<?php endif; ?>

				</div>

			</div>

		</div>

	</section>

	<section class="block supporters" id="support">
		<div class="container">
			<div class="support__inner">
				<div class="block-head">
					<h2>Sponsors, Funders &amp; Partners</h2>
				</div>

				<div class="supporters__group">
					<h3>Funders</h3>
					<div class="supporters__grid">
						<a
							class="supporter-logo"
							href="https://www.cnam.ie"
							target="_blank"
							rel="noopener"
							aria-label="Coimisiún na Meán website"
						>
							<img src="./images/tmp/CBE_web-thumb.jpg" alt="Coimisiún na Meán logo" />
						</a>
						<a
							class="supporter-logo"
							href="https://www.pobal.ie"
							target="_blank"
							rel="noopener"
							aria-label="Pobal website"
						>
							<img src="./images/tmp/Pobal-web-thumb.jpg" alt="Pobal logo" />
						</a>
						<a
							class="supporter-logo"
							href="https://www.gov.ie/en/organisation/department-of-rural-and-community-development/"
							target="_blank"
							rel="noopener"
							aria-label="Department of Rural and Community Development website"
						>
							<img
								src="./images/tmp/DRCD-logo-colour.jpg"
								alt="Department of Rural and Community Development logo"
							/>
						</a>
						<a
							class="supporter-logo"
							href="https://www.mayo.ie"
							target="_blank"
							rel="noopener"
							aria-label="Mayo County Council website"
						>
							<img
								src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='48'%3E%3Ctext x='50%25' y='50%25' font-family='Inter,sans-serif' font-size='13' font-weight='700' fill='%231c3d5a' text-anchor='middle' dominant-baseline='middle'%3EMayo County Council%3C/text%3E%3C/svg%3E"
								alt="Mayo County Council logo"
							/>
						</a>
					</div>
				</div>

				<div class="supporters__group">
					<h3>Partners</h3>
					<div class="supporters__grid">
						<a
							class="supporter-logo"
							href="https://craol.ie"
							target="_blank"
							rel="noopener"
							aria-label="Craol — Community Radio Forum of Ireland website"
						>
							<img
								src="./images/tmp/credit-union-thumb.jpg"
								alt="Craol — Community Radio Forum of Ireland logo"
							/>
						</a>
						<a
							class="supporter-logo"
							href="https://ccr946.ie"
							target="_blank"
							rel="noopener"
							aria-label="Digispace Claremorris"
						>
							<img src="./images/tmp/MSLETB_Logo-white-1536x575.jpg" alt="Digispace Claremorris logo" />
						</a>
					</div>
				</div>

				<div class="supporters__group">
					<h3>Local Sponsors</h3>
					<div class="supporters__grid">
						<a class="supporter-logo" href="#" aria-label="Sponsor logo placeholder 1">
							<img
								src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='48'%3E%3Ctext x='50%25' y='50%25' font-family='Inter,sans-serif' font-size='16' font-weight='700' fill='%231c3d5a' text-anchor='middle' dominant-baseline='middle'%3EGilligan%E2%80%99s Bar%3C/text%3E%3C/svg%3E"
								alt="Sponsor logo placeholder"
							/>
						</a>
						<a class="supporter-logo" href="#" aria-label="Sponsor logo placeholder 2">
							<img
								src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='48'%3E%3Ctext x='50%25' y='50%25' font-family='Inter,sans-serif' font-size='16' font-weight='700' fill='%231c3d5a' text-anchor='middle' dominant-baseline='middle'%3EWarde%E2%80%99s Pub%3C/text%3E%3C/svg%3E"
								alt="Sponsor logo placeholder"
							/>
						</a>
						<a class="supporter-logo" href="#" aria-label="Sponsor logo placeholder 3">
							<img
								src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='48'%3E%3Ctext x='50%25' y='50%25' font-family='Inter,sans-serif' font-size='14' font-weight='700' fill='%231c3d5a' text-anchor='middle' dominant-baseline='middle'%3EMacken%E2%80%99s Plumbing%3C/text%3E%3C/svg%3E"
								alt="Sponsor logo placeholder"
							/>
						</a>
						<a class="supporter-logo" href="#" aria-label="Sponsor logo placeholder 4">
							<img
								src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='48'%3E%3Ctext x='50%25' y='50%25' font-family='Inter,sans-serif' font-size='16' font-weight='700' fill='%231c3d5a' text-anchor='middle' dominant-baseline='middle'%3EPJ Byrne%E2%80%99s%3C/text%3E%3C/svg%3E"
								alt="Sponsor logo placeholder"
							/>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
