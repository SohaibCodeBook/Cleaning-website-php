<?php
/**
 * Template Name: Leistungen
 * Services overview page — full content to be built with reference design.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php echo esc_html( page_services( 'page_title', get_the_title() ) ); ?></h1>
		<p class="section-subtitle"><?php echo esc_html( page_services( 'page_subtitle' ) ); ?></p>
	</div>
</div>

<div class="page-content section">
	<div class="container-theme">
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
</div>

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
