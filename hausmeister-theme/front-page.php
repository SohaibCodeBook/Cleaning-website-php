<?php
/**
 * Front page template — Hero, Stats, Services, Why Us, Before & After, Google Reviews.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_image = hausmeister_get_image_url( 'hero_image', 'hero2.jpeg' );
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'hausmeister-theme' ); ?>">
	<div class="container-theme hero__container">
		<div class="hero__grid">
			<div class="hero__content">
				<div class="hero-badge" data-reveal="fade" style="--reveal-delay: 120ms">
					<span class="badge">
						<span class="badge__text"><?php echo esc_html( page_home( 'hero_badge' ) ); ?></span>
					</span>
				</div>

				<h1 class="hero__headline">
					<?php
					$hero_lines = array();
					for ( $hl = 1; $hl <= 3; $hl++ ) {
						$line = trim( (string) page_home( "hero_line_{$hl}" ) );
						if ( $line !== '' ) {
							$hero_lines[] = $line;
						}
					}
					$hero_line_delays = array( 380, 780, 1180 );
					foreach ( $hero_lines as $hl_index => $hero_line ) :
						$delay = isset( $hero_line_delays[ $hl_index ] ) ? $hero_line_delays[ $hl_index ] : ( 380 + ( $hl_index * 400 ) );
						?>
						<span class="hero__line" style="--reveal-delay: <?php echo esc_attr( (string) $delay ); ?>ms">
							<span class="hero__line-text"><?php echo esc_html( $hero_line ); ?><span class="teal-period">.</span></span>
						</span>
					<?php endforeach; ?>
				</h1>

				<p class="hero__subtitle" data-reveal="fade" style="--reveal-delay: 1850ms"><?php echo esc_html( page_home( 'hero_subtitle' ) ); ?></p>

				<div class="hero__ctas" data-reveal="fade" style="--reveal-delay: 2100ms">
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_primary_url' ) ) ); ?>" class="btn btn--primary btn--lg btn--has-arrow">
						<span class="btn__text"><?php echo esc_html( page_home( 'hero_btn_primary_text' ) ); ?></span>
						<svg class="btn__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</a>
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_secondary_url' ) ) ); ?>" class="btn btn--secondary btn--lg">
						<span class="btn__text"><?php echo esc_html( page_home( 'hero_btn_secondary_text' ) ); ?></span>
					</a>
				</div>

				<div class="hero__trust" data-reveal="fade" style="--reveal-delay: 2320ms">
					<?php for ( $t = 1; $t <= 3; $t++ ) : ?>
						<?php if ( $t > 1 ) : ?>
							<span class="hero__trust-sep" aria-hidden="true">&middot;</span>
						<?php endif; ?>
						<div class="hero__trust-item">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" aria-hidden="true"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
							<span><?php echo esc_html( page_home( "hero_trust_{$t}" ) ); ?></span>
						</div>
					<?php endfor; ?>
				</div>
			</div>

			<div class="hero__visual" data-reveal="fade-right" style="--reveal-delay: 200ms">
				<div class="hero__blob" aria-hidden="true"></div>
				<div class="hero__image-wrap">
					<img
						src="<?php echo esc_url( $hero_image ); ?>"
						alt="<?php echo esc_attr( site_data( 'company_name' ) ); ?>"
						class="hero__image"
						loading="eager"
						fetchpriority="high"
						width="1280"
						height="960"
					>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="stats-bar js-reveal" data-reveal-root aria-label="<?php esc_attr_e( 'Statistiken', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="stats-bar__grid">
			<?php for ( $s = 1; $s <= 4; $s++ ) : ?>
				<div class="stats-bar__item<?php echo $s > 1 ? ' stats-bar__item--border' : ''; ?>" data-reveal="up" style="--reveal-delay: <?php echo esc_attr( ( $s - 1 ) * 90 ); ?>ms">
					<div class="stat-card">
						<?php if ( page_home( "stat_{$s}_animate" ) === '0' ) : ?>
							<span class="stat-card__value"><?php echo esc_html( page_home( "stat_{$s}_display" ) ); ?></span>
						<?php else : ?>
							<span
								class="stat-card__value"
								data-counter
								data-target="<?php echo esc_attr( page_home( "stat_{$s}_target" ) ); ?>"
								data-suffix="<?php echo esc_attr( page_home( "stat_{$s}_suffix" ) ); ?>"
								data-prefix="<?php echo esc_attr( page_home( "stat_{$s}_prefix" ) ); ?>"
							>0<?php echo esc_html( page_home( "stat_{$s}_suffix" ) ); ?></span>
						<?php endif; ?>
						<span class="stat-card__label"><?php echo esc_html( page_home( "stat_{$s}_label" ) ); ?></span>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="services-section js-reveal" data-reveal-root aria-label="<?php esc_attr_e( 'Leistungen', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="section-header section-header--center services-section__header">
			<span class="section-label" data-reveal="up" style="--reveal-delay: 0ms"><?php echo esc_html( page_home( 'services_section_label' ) ); ?></span>
			<h2 class="section-header__title" data-reveal="up" style="--reveal-delay: 80ms">
				<?php echo esc_html( page_home( 'services_heading' ) ); ?><span class="teal-period">.</span>
			</h2>
			<p class="section-header__subtitle" data-reveal="up" style="--reveal-delay: 160ms"><?php echo esc_html( page_home( 'services_subheading' ) ); ?></p>
		</div>

		<div class="services-section__grid">
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<div class="services-section__cell" data-reveal="up" style="--reveal-delay: <?php echo esc_attr( 200 + ( $i - 1 ) * 80 ); ?>ms">
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( "service_{$i}_url" ) ) ); ?>" class="service-card">
						<div class="service-card__icon">
							<i class="<?php echo esc_attr( page_home( "service_{$i}_icon" ) ); ?>" aria-hidden="true"></i>
						</div>
						<h3 class="service-card__title"><?php echo esc_html( page_home( "service_{$i}_title" ) ); ?></h3>
						<p class="service-card__desc"><?php echo esc_html( page_home( "service_{$i}_description" ) ); ?></p>
						<?php
						$tags = hausmeister_parse_tags( page_home( "service_{$i}_tags" ) );
						if ( ! empty( $tags ) ) :
							?>
							<div class="service-card__features">
								<?php foreach ( $tags as $tag ) : ?>
									<span class="service-card__feature">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="12" height="12" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
										<?php echo esc_html( $tag ); ?>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<span class="service-card__link"><?php echo esc_html( page_home( 'service_link_text' ) ); ?> &rarr;</span>
					</a>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<?php
$why_image = hausmeister_get_image_url( 'why_image', 'Sascha Becker.jpeg' );
$default_quote = page_home( 'feature_1_quote' );
?>

<section class="why-us" data-why-us aria-label="<?php esc_attr_e( 'Warum wir', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="why-us__grid">
			<div class="why-us__content">
				<span class="section-label why-us__label" data-reveal style="--reveal-delay: 0ms"><?php echo esc_html( page_home( 'why_section_label' ) ); ?></span>
				<h2 class="why-us__title" data-reveal style="--reveal-delay: 80ms">
					<?php echo esc_html( page_home( 'features_heading' ) ); ?><span class="teal-period">.</span>
				</h2>
				<p class="why-us__intro" data-reveal style="--reveal-delay: 160ms"><?php echo esc_html( page_home( 'features_subheading' ) ); ?></p>

				<div class="why-us__pillars" role="tablist" aria-label="<?php esc_attr_e( 'Unsere Stärken', 'hausmeister-theme' ); ?>">
					<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
						<article
							class="why-pillar<?php echo 1 === $i ? ' is-active' : ''; ?>"
							data-why-pillar
							data-quote="<?php echo esc_attr( page_home( "feature_{$i}_quote" ) ); ?>"
							role="tab"
							tabindex="0"
							aria-selected="<?php echo 1 === $i ? 'true' : 'false'; ?>"
						>
							<span class="why-pillar__num"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span>
							<div class="why-pillar__icon" aria-hidden="true">
								<i class="<?php echo esc_attr( page_home( "feature_{$i}_icon" ) ); ?>"></i>
							</div>
							<div class="why-pillar__body">
								<h3 class="why-pillar__title"><?php echo esc_html( page_home( "feature_{$i}_title" ) ); ?></h3>
								<p class="why-pillar__desc"><?php echo esc_html( page_home( "feature_{$i}_description" ) ); ?></p>
							</div>
							<span class="why-pillar__indicator" aria-hidden="true"></span>
						</article>
					<?php endfor; ?>
				</div>
			</div>

			<div class="why-us__visual">
				<div class="why-us__image-frame">
					<div class="why-us__image-accent" aria-hidden="true"></div>
					<div class="why-us__image-wrap">
						<img
							src="<?php echo esc_url( $why_image ); ?>"
							alt="<?php echo esc_attr( page_home( 'features_heading' ) ); ?>"
							class="why-us__image"
							loading="lazy"
							width="800"
							height="1000"
						>
					</div>
					<blockquote class="why-us__quote-card" data-why-quote-card>
						<p data-why-quote-text><?php echo esc_html( $default_quote ); ?></p>
						<cite><?php echo esc_html( page_home( 'why_quote_author' ) ); ?></cite>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ba-gallery" data-ba-gallery aria-label="<?php esc_attr_e( 'Vorher und Nachher', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="ba-gallery__header">
			<span class="section-label"><?php echo esc_html( page_home( 'ba_section_label' ) ); ?></span>
			<h2 class="ba-gallery__title">
				<?php echo esc_html( page_home( 'ba_heading' ) ); ?><span class="teal-period">.</span>
			</h2>
			<p class="ba-gallery__subtitle"><?php echo esc_html( page_home( 'ba_subheading' ) ); ?></p>
		</div>

		<div class="ba-grid" data-ba-grid>
			<?php
			for ( $i = 1; $i <= 5; $i++ ) {
				get_template_part(
					'template-parts/ba-comparison',
					'card',
					array(
						'ba_index' => $i,
					)
				);
			}
			for ( $i = 6; $i <= 12; $i++ ) {
				get_template_part(
					'template-parts/ba-comparison',
					'card',
					array(
						'ba_index' => $i,
						'ba_extra' => true,
					)
				);
			}
			?>
		</div>

		<div class="ba-gallery__more" data-ba-more-wrap>
			<button type="button" class="btn btn--secondary ba-gallery__more-btn" data-ba-more>
				<?php echo esc_html( page_home( 'ba_more_btn_text' ) ); ?>
			</button>
			<button type="button" class="btn btn--secondary ba-gallery__more-btn" data-ba-less hidden>
				<?php echo esc_html( page_home( 'ba_less_btn_text' ) ); ?>
			</button>
		</div>
	</div>
</section>

<?php
$work_gallery = hausmeister_get_work_gallery_images();
if ( ! empty( $work_gallery ) ) :
	$gallery_subheading = page_home( 'gallery_subheading' );
	?>
<section class="work-gallery" data-work-gallery-section aria-label="<?php esc_attr_e( 'Galerie unserer Arbeiten', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="work-gallery__header">
			<span class="section-label"><?php echo esc_html( page_home( 'gallery_section_label' ) ); ?></span>
			<h2 class="work-gallery__title">
				<?php echo esc_html( page_home( 'gallery_heading' ) ); ?>
				<span class="work-gallery__star" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
						<path d="M12 2.5l2.72 6.62 7.18.62-5.4 4.72 1.62 7.04L12 17.77l-6.12 3.73 1.62-7.04-5.4-4.72 7.18-.62L12 2.5z"/>
					</svg>
				</span>
			</h2>
			<?php if ( $gallery_subheading !== '' ) : ?>
				<p class="work-gallery__subtitle"><?php echo esc_html( $gallery_subheading ); ?></p>
			<?php endif; ?>
		</div>

		<div class="work-gallery__grid" data-work-gallery>
			<?php foreach ( $work_gallery as $index => $item ) : ?>
				<figure class="work-gallery__item work-gallery__item--<?php echo esc_attr( $item['span'] ); ?>">
					<button
						type="button"
						class="work-gallery__trigger"
						data-gallery-open
						data-gallery-index="<?php echo esc_attr( (string) $index ); ?>"
						aria-label="<?php echo esc_attr( sprintf( __( 'Bild vergrößern: %s', 'hausmeister-theme' ), $item['alt'] ) ); ?>"
					>
						<img
							src="<?php echo esc_url( $item['url'] ); ?>"
							alt="<?php echo esc_attr( $item['alt'] ); ?>"
							width="<?php echo esc_attr( (string) $item['width'] ); ?>"
							height="<?php echo esc_attr( (string) $item['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</button>
				</figure>
			<?php endforeach; ?>
		</div>

		<div class="work-gallery__more" data-gallery-more-wrap hidden>
			<button type="button" class="btn btn--secondary work-gallery__more-btn" data-gallery-more>
				<?php echo esc_html( page_home( 'gallery_more_btn_text' ) ); ?>
			</button>
			<button type="button" class="btn btn--secondary work-gallery__more-btn" data-gallery-less hidden>
				<?php echo esc_html( page_home( 'gallery_less_btn_text' ) ); ?>
			</button>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
$reviews_google_url = page_home( 'reviews_google_url' );
$reviews_visible    = 0;
for ( $r = 1; $r <= 7; $r++ ) {
	if ( hausmeister_review_is_visible( $r ) ) {
		$reviews_visible++;
	}
}
?>

<?php if ( $reviews_visible > 0 ) : ?>
<section class="google-reviews" data-google-reviews aria-label="<?php esc_attr_e( 'Google Bewertungen', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="google-reviews__header">
			<span class="section-label"><?php echo esc_html( page_home( 'reviews_section_label' ) ); ?></span>
			<h2 class="google-reviews__title">
				<?php echo esc_html( page_home( 'reviews_heading' ) ); ?><span class="teal-period">.</span>
			</h2>
			<p class="google-reviews__subtitle"><?php echo esc_html( page_home( 'reviews_subheading' ) ); ?></p>
		</div>

		<div class="google-reviews__widget">
			<div class="google-reviews__layout">
				<aside class="google-reviews__summary">
					<div class="google-reviews__summary-inner">
						<div class="google-reviews__brand">
							<svg class="google-reviews__logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="28" height="28" aria-hidden="true">
								<path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
								<path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
								<path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
								<path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
							</svg>
							<span class="google-reviews__brand-text">Google</span>
						</div>

						<div class="google-reviews__score"><?php echo esc_html( page_home( 'reviews_overall_rating' ) ); ?></div>
						<?php echo hausmeister_render_google_stars( page_home( 'reviews_overall_rating' ), 'lg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<p class="google-reviews__count">
							<?php
							printf(
								/* translators: %s: number of Google reviews */
								esc_html__( '%s Bewertungen', 'hausmeister-theme' ),
								esc_html( page_home( 'reviews_total_count' ) )
							);
							?>
						</p>

						<?php if ( $reviews_google_url ) : ?>
							<a
								href="<?php echo esc_url( $reviews_google_url ); ?>"
								class="google-reviews__link-btn"
								target="_blank"
								rel="noopener noreferrer"
							>
								<?php echo esc_html( page_home( 'reviews_btn_text' ) ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
							</a>
						<?php endif; ?>
					</div>
				</aside>

				<div class="google-reviews__reviews">
					<div class="google-reviews__track" data-reviews-track tabindex="0">
						<?php
						for ( $i = 1; $i <= 7; $i++ ) {
							get_template_part(
								'template-parts/google-review',
								'card',
								array(
									'review_index' => $i,
								)
							);
						}
						?>
					</div>

					<div class="google-reviews__controls">
						<button type="button" class="google-reviews__nav google-reviews__nav--prev" data-reviews-prev aria-label="<?php esc_attr_e( 'Vorherige Bewertungen', 'hausmeister-theme' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
						</button>
						<button type="button" class="google-reviews__nav google-reviews__nav--next" data-reviews-next aria-label="<?php esc_attr_e( 'Nächste Bewertungen', 'hausmeister-theme' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="home-quote" aria-label="<?php esc_attr_e( 'Anfrage', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="section-header section-header--center home-quote__header">
			<span class="section-label"><?php esc_html_e( 'Kontakt', 'hausmeister-theme' ); ?></span>
			<h2 class="section-header__title">
				<?php echo esc_html( page_home( 'cta_heading' ) ); ?><span class="teal-period">.</span>
			</h2>
			<p class="section-header__subtitle"><?php echo esc_html( page_home( 'cta_text' ) ); ?></p>
		</div>

		<div class="home-quote__form">
			<?php
			hausmeister_render_quote_form(
				array(
					'id'    => 'home-quote-form',
					'title' => __( 'Nachricht senden', 'hausmeister-theme' ),
				)
			);
			?>
		</div>
	</div>
</section>

<?php
get_footer();
