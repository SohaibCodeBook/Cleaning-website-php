<?php
/**
 * Header template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

<header class="site-header">
	<div class="container-theme">
		<div class="header-inner">
			<div class="site-logo">
				<?php hausmeister_the_logo(); ?>
			</div>

			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'hausmeister-theme' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav-list',
					'fallback_cb'    => 'hausmeister_fallback_menu',
					'walker'         => new Hausmeister_Nav_Walker(),
				) );
				?>
			</nav>

			<div class="header-cta">
				<a href="<?php echo esc_url( hausmeister_theme_url( site_data( 'header_cta_url' ) ) ); ?>" class="btn-primary">
					<?php echo esc_html( site_data( 'header_cta_text' ) ); ?>
				</a>
			</div>

			<button class="nav-toggle" type="button" aria-label="<?php esc_attr_e( 'Menü öffnen', 'hausmeister-theme' ); ?>" aria-expanded="false">
				<i class="fa-solid fa-bars" aria-hidden="true"></i>
			</button>
		</div>
	</div>
</header>

<div class="mobile-nav-overlay" aria-hidden="true"></div>
<aside class="mobile-nav-drawer" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'hausmeister-theme' ); ?>">
	<button class="mobile-nav-close" type="button" aria-label="<?php esc_attr_e( 'Menü schließen', 'hausmeister-theme' ); ?>">
		<i class="fa-solid fa-xmark" aria-hidden="true"></i>
	</button>
	<nav>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'nav-list',
			'fallback_cb'    => 'hausmeister_fallback_menu',
			'walker'         => new Hausmeister_Nav_Walker(),
		) );
		?>
	</nav>
	<div class="mt-4">
		<a href="<?php echo esc_url( hausmeister_theme_url( site_data( 'header_cta_url' ) ) ); ?>" class="btn-primary w-100 text-center">
			<?php echo esc_html( site_data( 'header_cta_text' ) ); ?>
		</a>
	</div>
</aside>

<main class="site-main">
