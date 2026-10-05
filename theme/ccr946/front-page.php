<?php get_header(); ?>

<main id="page-content" class="site-main content">

	<!-- <section class="hero">
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
	</section> -->

	<section class="listen-hero">
		<div class="container">
			<div class="listen-hero__inner">
				<span id="onair-badge" class="onair-badge"><span class="on-dot"></span>ON AIR</span>

				<div class="dial">
					<div class="dial__screen dial__screen--top">
						<div class="dial__top">
							<div class="freq">94.6<span>FM</span></div>
							<div class="eq"><span></span><span></span><span></span><span></span><span></span></div>
						</div>
						<div class="dial__nowplaying">
							<div class="label">NOW PLAYING</div>
							<div class="track" id="hero-track"></div>
						</div>
					</div>
					<div class="dial__scale">
						<svg viewBox="0 0 500 60" preserveAspectRatio="xMidYMid meet">
							<circle class="dial__glow" cx="160" cy="18" r="22" />
							<g class="ticks">
								<line x1="10" y1="10" x2="10" y2="24" class="major" />
								<line x1="60" y1="10" x2="60" y2="20" />
								<line x1="110" y1="10" x2="110" y2="20" />
								<line x1="160" y1="10" x2="160" y2="24" class="major" />
								<line x1="210" y1="10" x2="210" y2="20" />
								<line x1="260" y1="10" x2="260" y2="20" />
								<line x1="310" y1="10" x2="310" y2="24" class="major" />
								<line x1="360" y1="10" x2="360" y2="20" />
								<line x1="410" y1="10" x2="410" y2="20" />
								<line x1="460" y1="10" x2="460" y2="24" class="major" />
								<line x1="490" y1="10" x2="490" y2="20" />
							</g>
							<g class="labels">
								<text x="12" y="46" text-anchor="middle">88</text>
								<text x="160" y="46" text-anchor="middle" class="tuned">94.6</text>
								<text x="310" y="46" text-anchor="middle">101</text>
								<text x="460" y="46" text-anchor="middle">108</text>
							</g>
							<line class="dial__needle--top" x1="160" y1="4" x2="160" y2="30" />
						</svg>
					</div>

					<div class="dial__controls">
						<button class="dial__play" id="dialPlayBtn" aria-label="Play live stream" aria-pressed="false">
							<span class="icon-play"></span>
							<span class="icon-pause"><span></span><span></span></span>
							<span class="caption" >Listen live</span>
						</button>
					</div>
				</div>

				<h1>Claremorris Community Radio</h1>

				<p class="lead">
					You've found us loud and clear — 94.6FM, broadcasting live from Claremorris, Co. Mayo. Press play and
					stay a while.
				</p>

				<p class="stream-note">
					Listening on your phone? The player stays docked at the top of every page, so you can browse
					<a href="ccr946-shows.html">Shows</a> or <a href="ccr946-news-list.html">News</a> without losing the
					signal.
				</p>
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

	<section class="block block--alt cta">
		<div class="container">
			<div class="cta__inner">
				<h2>Want to know what's coming up?</h2>
				<p>See the full line-up for the week, or browse every show on the station.</p>
				<div class="cta__row">
					<a class="cta__btn primary" href="<?php echo esc_url( home_url( '/schedule/' ) ); ?>">View Schedule</a>
					<a class="cta__btn secondary" href="<?php echo esc_url( get_post_type_archive_link( 'show' ) ); ?>">Browse Shows</a>
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

				<div class="supporters__gratitude">
					<h3>
						We are proud to be supported by organisations that help our community thrive.
					</h3>
				</div>

				<?php
				$supporter_groups = [
					'funder'        => 'Funders',
					'partner'       => 'Partners',
					'local_sponsor' => 'Local Sponsors',
				];

				foreach ( $supporter_groups as $category => $label ) :

					$supporters = new WP_Query( [
						'post_type'      => 'supporter',
						'posts_per_page' => -1,
						'post_status'    => 'publish',
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'meta_query'     => [
							[
								'key'     => 'category',
								'value'   => $category,
								'compare' => '=',
							],
						],
					] );

					if ( ! $supporters->have_posts() ) {
						wp_reset_postdata();
						continue;
					}
				?>

					<div class="supporters__group">

						<h3><?php echo esc_html( $label ); ?></h3>

						<div class="supporters__grid">

							<?php while ( $supporters->have_posts() ) : $supporters->the_post(); ?>

								<?php
								$website = get_field( 'website' );
								$title   = get_the_title();
								?>

								<a
									class="supporter-logo"
									href="<?php echo esc_url( $website ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									aria-label="<?php echo esc_attr( $title . ' website' ); ?>"
								>
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail(
											'medium',
											[
												'alt' => $title . ' logo',
											]
										);
									}
									?>
								</a>

							<?php endwhile; ?>

						</div>

					</div>

				<?php
					wp_reset_postdata();

				endforeach;
				?>

			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
