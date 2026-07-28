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
</div>
