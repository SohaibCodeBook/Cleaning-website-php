<?php
/**
 * 404 error template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="error-404">
	<h1>404</h1>
	<h2><?php esc_html_e( 'Seite nicht gefunden', 'hausmeister-theme' ); ?></h2>
	<p><?php esc_html_e( 'Die angeforderte Seite existiert leider nicht oder wurde verschoben.', 'hausmeister-theme' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
		<?php esc_html_e( 'Zur Startseite', 'hausmeister-theme' ); ?>
	</a>
</div>

<?php
get_footer();
