<?php
/**
 * Front page template — Hero, Stats, Services, Why Us, Before & After.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_image = hausmeister_get_image_url( 'hero_image', 'hero.jpg' );
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'hausmeister-theme' ); ?>">
	<div class="container-theme hero__container">
		<div class="hero__grid">
			<div class="hero__content">
				<div class="hero-badge">
					<span class="badge">
						<span class="badge__text"><?php echo esc_html( page_home( 'hero_badge' ) ); ?></span>
					</span>
				</div>

				<h1 class="hero__headline">
					<span class="hero__line"><?php echo esc_html( page_home( 'hero_line_1' ) ); ?><span class="teal-period">.</span></span>
					<span class="hero__line"><?php echo esc_html( page_home( 'hero_line_2' ) ); ?><span class="teal-period">.</span></span>
					<span class="hero__line"><?php echo esc_html( page_home( 'hero_line_3' ) ); ?><span class="teal-period">.</span></span>
				</h1>

				<p class="hero__subtitle"><?php echo esc_html( page_home( 'hero_subtitle' ) ); ?></p>

				<div class="hero__ctas">
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_primary_url' ) ) ); ?>" class="btn btn--primary btn--lg btn--has-arrow">
						<span class="btn__text"><?php echo esc_html( page_home( 'hero_btn_primary_text' ) ); ?></span>
						<svg class="btn__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</a>
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_secondary_url' ) ) ); ?>" class="btn btn--secondary btn--lg">
						<span class="btn__text"><?php echo esc_html( page_home( 'hero_btn_secondary_text' ) ); ?></span>
					</a>
				</div>

				<div class="hero__trust">
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

			<div class="hero__visual">
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

<section class="stats-bar" aria-label="<?php esc_attr_e( 'Statistiken', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="stats-bar__grid">
			<?php for ( $s = 1; $s <= 4; $s++ ) : ?>
				<div class="stats-bar__item<?php echo $s > 1 ? ' stats-bar__item--border' : ''; ?>">
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

<section class="services-section" aria-label="<?php esc_attr_e( 'Leistungen', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="section-header section-header--center services-section__header">
			<span class="section-label"><?php echo esc_html( page_home( 'services_section_label' ) ); ?></span>
			<h2 class="section-header__title">
				<?php echo esc_html( page_home( 'services_heading' ) ); ?><span class="teal-period">.</span>
			</h2>
			<p class="section-header__subtitle"><?php echo esc_html( page_home( 'services_subheading' ) ); ?></p>
		</div>

		<div class="services-section__grid">
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<div class="services-section__cell">
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
$why_image = hausmeister_get_image_url( 'why_image', 'why-us.jpg' );
$default_quote = page_home( 'feature_1_quote' );
?>

<section class="why-us" data-why-us aria-label="<?php esc_attr_e( 'Warum wir', 'hausmeister-theme' ); ?>">
	<div class="container-theme">
		<div class="why-us__grid">
			<div class="why-us__content">
				<span class="section-label why-us__label" data-reveal><?php echo esc_html( page_home( 'why_section_label' ) ); ?></span>
				<h2 class="why-us__title" data-reveal>
					<?php echo esc_html( page_home( 'features_heading' ) ); ?><span class="teal-period">.</span>
				</h2>
				<p class="why-us__intro" data-reveal><?php echo esc_html( page_home( 'features_subheading' ) ); ?></p>

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

		<div class="ba-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Leistungen filtern', 'hausmeister-theme' ); ?>">
			<?php foreach ( hausmeister_get_ba_filters() as $slug => $label ) : ?>
				<button
					type="button"
					class="ba-tabs__btn<?php echo 'all' === $slug ? ' is-active' : ''; ?>"
					role="tab"
					data-ba-tab="<?php echo esc_attr( $slug ); ?>"
					aria-selected="<?php echo 'all' === $slug ? 'true' : 'false'; ?>"
				>
					<?php echo esc_html( $label ); ?>
				</button>
			<?php endforeach; ?>
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
			?>
		</div>

		<p class="ba-gallery__empty" data-ba-empty hidden>
			<?php esc_html_e( 'Für diese Leistung sind noch keine Vergleichsbilder hinterlegt.', 'hausmeister-theme' ); ?>
		</p>
	</div>
</section>

<?php
get_footer();
