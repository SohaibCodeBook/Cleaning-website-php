<?php
/**
 * Setup wizard — auto-create pages, menu, and front page on theme activation.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Run setup on theme activation.
 */
function hausmeister_theme_activation_setup() {
	if ( get_option( 'hausmeister_theme_setup_done' ) ) {
		return;
	}

	$pages = hausmeister_create_pages();
	hausmeister_create_primary_menu( $pages );
	hausmeister_set_front_page( $pages );

	update_option( 'hausmeister_theme_setup_done', true );
}
add_action( 'after_switch_theme', 'hausmeister_theme_activation_setup' );

/**
 * Create required pages.
 *
 * @return array Map of slug => page ID.
 */
function hausmeister_create_pages() {
	$page_definitions = array(
		'startseite' => array(
			'title'    => 'Startseite',
			'template' => '',
		),
		'leistungen' => array(
			'title'    => 'Leistungen',
			'template' => 'page-leistungen.php',
		),
		'ueber-uns' => array(
			'title'    => 'Über uns',
			'template' => 'page-ueber-uns.php',
		),
		'kontakt' => array(
			'title'    => 'Kontakt',
			'template' => 'page-kontakt.php',
		),
	);

	$created = array();

	foreach ( $page_definitions as $slug => $def ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$created[ $slug ] = $existing->ID;
			continue;
		}

		$page_id = wp_insert_post( array(
			'post_title'   => $def['title'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );

		if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $def['template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $def['template'] );
		}

		$created[ $slug ] = $page_id;
	}

	return $created;
}

/**
 * Build primary navigation menu.
 *
 * @param array $pages Map of slug => page ID.
 */
function hausmeister_create_primary_menu( $pages ) {
	$menu_name = 'Hauptmenü';
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu_exists ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = $menu_exists->term_id;
	}

	if ( ! $menu_id || is_wp_error( $menu_id ) ) {
		return;
	}

	$menu_order = array( 'startseite', 'leistungen', 'ueber-uns', 'kontakt' );
	$position   = 1;

	foreach ( $menu_order as $slug ) {
		if ( empty( $pages[ $slug ] ) ) {
			continue;
		}

		$page_id = $pages[ $slug ];
		$exists  = false;

		$menu_items = wp_get_nav_menu_items( $menu_id );
		if ( $menu_items ) {
			foreach ( $menu_items as $item ) {
				if ( (int) $item->object_id === (int) $page_id ) {
					$exists = true;
					break;
				}
			}
		}

		if ( ! $exists ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'     => get_the_title( $page_id ),
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page_id,
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => $position,
			) );
		}

		$position++;
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Set static front page.
 *
 * @param array $pages Map of slug => page ID.
 */
function hausmeister_set_front_page( $pages ) {
	if ( empty( $pages['startseite'] ) ) {
		return;
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $pages['startseite'] );
}
