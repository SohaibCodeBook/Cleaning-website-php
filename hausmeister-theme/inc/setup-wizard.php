<?php
/**
 * Setup wizard — auto-create pages, menu, and front page on theme activation.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Required page slugs for this theme.
 *
 * @return string[]
 */
function hausmeister_get_required_page_slugs() {
	return array( 'startseite', 'leistungen', 'ueber-uns', 'kontakt' );
}

/**
 * Check whether all required pages exist and are published.
 *
 * @return bool
 */
function hausmeister_has_all_pages() {
	foreach ( hausmeister_get_required_page_slugs() as $slug ) {
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( ! $page || 'publish' !== $page->post_status ) {
			return false;
		}
	}
	return true;
}

/**
 * Run setup on theme activation.
 */
function hausmeister_theme_activation_setup() {
	if ( get_option( 'hausmeister_theme_setup_done' ) && hausmeister_has_all_pages() ) {
		return;
	}

	hausmeister_run_theme_setup();
}
add_action( 'after_switch_theme', 'hausmeister_theme_activation_setup' );

/**
 * Fallback: recreate missing pages when an admin visits the dashboard.
 */
function hausmeister_admin_setup_fallback() {
	if ( ! is_admin() || ! current_user_can( 'edit_pages' ) || hausmeister_has_all_pages() ) {
		return;
	}

	hausmeister_run_theme_setup();
}
add_action( 'admin_init', 'hausmeister_admin_setup_fallback', 5 );

/**
 * Show admin notice if pages are still missing after setup attempt.
 */
function hausmeister_admin_missing_pages_notice() {
	if ( ! current_user_can( 'manage_options' ) || hausmeister_has_all_pages() ) {
		return;
	}

	echo '<div class="notice notice-error"><p>';
	echo esc_html__( 'Hausmeister Theme: Einige Seiten fehlen noch. Bitte laden Sie diese Admin-Seite neu — das Theme erstellt sie automatisch.', 'hausmeister-theme' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'hausmeister_admin_missing_pages_notice' );

/**
 * Execute page, menu, and front-page setup.
 */
function hausmeister_run_theme_setup() {
	$pages = hausmeister_create_pages();
	hausmeister_create_primary_menu( $pages );
	hausmeister_set_front_page( $pages );

	if ( hausmeister_has_all_pages() ) {
		update_option( 'hausmeister_theme_setup_done', true );
	} else {
		delete_option( 'hausmeister_theme_setup_done' );
	}
}

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
		'ueber-uns'  => array(
			'title'    => 'Über uns',
			'template' => 'page-ueber-uns.php',
		),
		'kontakt'    => array(
			'title'    => 'Kontakt',
			'template' => 'page-kontakt.php',
		),
	);

	$author  = get_current_user_id();
	$author  = $author ? $author : 1;
	$created = array();

	foreach ( $page_definitions as $slug => $def ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing && 'publish' === $existing->post_status ) {
			$created[ $slug ] = $existing->ID;
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $def['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
				'post_author'  => $author,
			),
			true
		);

		if ( is_wp_error( $page_id ) || ! $page_id ) {
			continue;
		}

		if ( ! empty( $def['template'] ) ) {
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
	$menu_name   = 'Hauptmenü';
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu_exists ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = $menu_exists->term_id;
	}

	if ( ! $menu_id || is_wp_error( $menu_id ) ) {
		return;
	}

	$menu_order = hausmeister_get_required_page_slugs();
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
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => get_the_title( $page_id ),
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page_id,
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position,
				)
			);
		}

		$position++;
	}

	$locations            = get_theme_mod( 'nav_menu_locations', array() );
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
