<?php
/**
 * Template Name: Über uns
 * About page — full content to be built with reference design.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php echo esc_html( page_about( 'page_title', get_the_title() ) ); ?></h1>
		<p class="section-subtitle"><?php echo esc_html( page_about( 'page_subtitle' ) ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="entry-content">
			<?php echo wp_kses_post( wpautop( page_about( 'intro_text' ) ) ); ?>
		</div>

		<div class="features-grid mt-5">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<div class="feature-item">
					<div class="feature-icon">
						<i class="<?php echo esc_attr( page_about( "value_{$i}_icon" ) ); ?>" aria-hidden="true"></i>
					</div>
					<h3><?php echo esc_html( page_about( "value_{$i}_title" ) ); ?></h3>
					<p><?php echo esc_html( page_about( "value_{$i}_description" ) ); ?></p>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</div>

<?php
get_footer();
