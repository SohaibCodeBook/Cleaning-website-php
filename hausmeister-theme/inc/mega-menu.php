<?php
/**
 * Services mega menu helpers.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get all configured services for navigation and mega menu.
 *
 * @return array<int, array<string, mixed>>
 */
function hausmeister_get_services() {
	$services = array();

	for ( $i = 1; $i <= 5; $i++ ) {
		$title = page_home( "service_{$i}_title" );
		if ( $title === '' ) {
			continue;
		}

		$slug = '';
		foreach ( hausmeister_get_service_slug_map() as $service_slug => $index ) {
			if ( (int) $index === $i ) {
				$slug = $service_slug;
				break;
			}
		}

		$page = $slug ? hausmeister_get_service_page_by_slug( $slug ) : null;
		$url  = $page ? get_permalink( $page ) : hausmeister_theme_url( page_home( "service_{$i}_url" ) );

		$services[] = array(
			'id'       => $i,
			'icon'     => page_home( "service_{$i}_icon" ),
			'title'    => $title,
			'subtitle' => page_home( "service_{$i}_subtitle" ),
			'url'      => $url,
		);
	}

	return $services;
}

/**
 * Check whether a menu item should show the services mega menu.
 *
 * @param WP_Post $item Menu item object.
 * @return bool
 */
function hausmeister_is_leistungen_menu_item( $item ) {
	if ( in_array( 'leistungen-mega-menu', (array) $item->classes, true ) ) {
		return true;
	}

	$title = isset( $item->title ) ? strtolower( trim( wp_strip_all_tags( $item->title ) ) ) : '';
	return in_array( $title, array( 'leistungen', 'services', 'our services' ), true );
}

/**
 * Inline chevron for mega menu triggers.
 *
 * @return string
 */
function hausmeister_mega_menu_chevron_svg() {
	return '<svg class="nav-link__chevron" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>';
}

/**
 * Render the services mega menu panel markup.
 *
 * @return void
 */
function hausmeister_render_services_mega_menu() {
	get_template_part( 'template-parts/mega-menu', 'services' );
}
