<?php
/**
 * Front page template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="hero-section">
	<div class="container-theme">
		<h1><?php echo esc_html( page_home( 'hero_title' ) ); ?></h1>
		<p><?php echo esc_html( page_home( 'hero_subtitle' ) ); ?></p>
		<div class="hero-buttons">
			<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_primary_url' ) ) ); ?>" class="btn-primary">
				<?php echo esc_html( page_home( 'hero_btn_primary_text' ) ); ?>
			</a>
			<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'hero_btn_secondary_url' ) ) ); ?>" class="btn-outline">
				<?php echo esc_html( page_home( 'hero_btn_secondary_text' ) ); ?>
			</a>
		</div>
	</div>
</section>

<section class="section">
	<div class="container-theme">
		<h2 class="section-title"><?php echo esc_html( page_home( 'services_heading' ) ); ?></h2>
		<p class="section-subtitle"><?php echo esc_html( page_home( 'services_subheading' ) ); ?></p>

		<div class="services-grid">
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<article class="service-card">
					<div class="service-icon">
						<i class="<?php echo esc_attr( page_home( "service_{$i}_icon" ) ); ?>" aria-hidden="true"></i>
					</div>
					<h3><?php echo esc_html( page_home( "service_{$i}_title" ) ); ?></h3>
					<p><?php echo esc_html( page_home( "service_{$i}_description" ) ); ?></p>
					<a href="<?php echo esc_url( hausmeister_theme_url( page_home( "service_{$i}_url" ) ) ); ?>" class="service-link">
						<?php echo esc_html( page_home( 'service_link_text' ) ); ?> &rarr;
					</a>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="section section-alt">
	<div class="container-theme">
		<h2 class="section-title"><?php echo esc_html( page_home( 'features_heading' ) ); ?></h2>
		<p class="section-subtitle"><?php echo esc_html( page_home( 'features_subheading' ) ); ?></p>

		<div class="features-grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<div class="feature-item">
					<div class="feature-icon">
						<i class="<?php echo esc_attr( page_home( "feature_{$i}_icon" ) ); ?>" aria-hidden="true"></i>
					</div>
					<h3><?php echo esc_html( page_home( "feature_{$i}_title" ) ); ?></h3>
					<p><?php echo esc_html( page_home( "feature_{$i}_description" ) ); ?></p>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="cta-banner">
	<div class="container-theme">
		<h2><?php echo esc_html( page_home( 'cta_heading' ) ); ?></h2>
		<p><?php echo esc_html( page_home( 'cta_text' ) ); ?></p>
		<a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'cta_btn_url' ) ) ); ?>" class="btn-primary">
			<?php echo esc_html( page_home( 'cta_btn_text' ) ); ?>
		</a>
	</div>
</section>

<?php
get_footer();
