<?php
/**
 * Services mega menu panel.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

$services = hausmeister_get_services();

if ( empty( $services ) ) {
	return;
}

$leistungen_page = get_page_by_path( 'leistungen' );
$overview_url    = $leistungen_page ? get_permalink( $leistungen_page ) : hausmeister_theme_url( '/leistungen/' );
?>

<div class="mega-menu">
	<div class="mega-menu__grid" role="menu">
		<?php foreach ( $services as $service ) : ?>
			<a
				href="<?php echo esc_url( $service['url'] ); ?>"
				class="mega-menu__item"
				role="menuitem"
			>
				<span class="mega-menu__icon" aria-hidden="true">
					<i class="<?php echo esc_attr( $service['icon'] ); ?>"></i>
				</span>
				<span class="mega-menu__copy">
					<span class="mega-menu__title"><?php echo esc_html( $service['title'] ); ?></span>
					<?php if ( $service['subtitle'] ) : ?>
						<span class="mega-menu__subtitle"><?php echo esc_html( $service['subtitle'] ); ?></span>
					<?php endif; ?>
				</span>
			</a>
		<?php endforeach; ?>
	</div>

	<div class="mega-menu__footer">
		<a href="<?php echo esc_url( $overview_url ); ?>" class="mega-menu__overview">
			<?php esc_html_e( 'Alle Leistungen ansehen', 'hausmeister-theme' ); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
		</a>
	</div>
</div>
