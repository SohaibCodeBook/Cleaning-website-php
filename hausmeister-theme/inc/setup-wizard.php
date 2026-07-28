<?php
/**
 * Setup wizard — auto-create pages, menu, and front page on theme activation.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Required top-level page slugs (no services overview page).
 *
 * @return string[]
 */
function hausmeister_get_required_page_slugs() {
	return array( 'startseite', 'ueber-uns', 'kontakt' );
}

/**
 * Primary menu order including the Leistungen mega-menu trigger.
 *
 * @return string[]
 */
function hausmeister_get_primary_menu_slugs() {
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
 * Check whether all service sub-pages exist.
 *
 * @return bool
 */
function hausmeister_has_all_service_pages() {
	foreach ( hausmeister_get_service_content_blueprints() as $data ) {
		if ( ! hausmeister_get_service_page_by_slug( $data['slug'] ) ) {
			return false;
		}
	}

	return true;
}

/**
 * Run setup on theme activation.
 */
function hausmeister_theme_activation_setup() {
	if ( get_option( 'hausmeister_theme_setup_done' ) && hausmeister_has_all_pages() && hausmeister_has_all_service_pages() ) {
		return;
	}

	hausmeister_run_theme_setup();
}
add_action( 'after_switch_theme', 'hausmeister_theme_activation_setup' );

/**
 * Fallback: recreate missing pages when an admin visits the dashboard.
 */
function hausmeister_admin_setup_fallback() {
	if ( ! is_admin() || ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	if ( ! hausmeister_has_all_pages() || ! hausmeister_has_all_service_pages() ) {
		hausmeister_run_theme_setup();
	}
}
add_action( 'admin_init', 'hausmeister_admin_setup_fallback', 5 );

/**
 * Keep Leistungen menu items on the mega-menu trigger after theme updates.
 */
function hausmeister_admin_sync_leistungen_menu() {
	if ( ! is_admin() || ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		return;
	}

	hausmeister_sync_leistungen_menu_trigger( (int) $locations['primary'] );
}
add_action( 'admin_init', 'hausmeister_admin_sync_leistungen_menu', 6 );

/**
 * Show admin notice if pages are still missing after setup attempt.
 */
function hausmeister_admin_missing_pages_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( hausmeister_has_all_pages() && hausmeister_has_all_service_pages() ) {
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
	hausmeister_create_service_pages();
	hausmeister_create_primary_menu( $pages );
	hausmeister_set_front_page( $pages );

	if ( hausmeister_has_all_pages() && hausmeister_has_all_service_pages() ) {
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
 * Create top-level service pages (no Leistungen overview parent).
 */
function hausmeister_create_service_pages() {
	$author     = get_current_user_id();
	$author     = $author ? $author : 1;
	$blueprints = hausmeister_get_service_content_blueprints();

	foreach ( $blueprints as $index => $data ) {
		$existing = hausmeister_get_service_page_by_slug( $data['slug'] );

		if ( $existing ) {
			if ( 'page-service.php' !== get_page_template_slug( $existing ) ) {
				update_post_meta( $existing->ID, '_wp_page_template', 'page-service.php' );
			}
			continue;
		}

		$title = page_home( "service_{$index}_title", '' );
		if ( $title === '' ) {
			$title = ucfirst( str_replace( '-', ' ', $data['slug'] ) );
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $data['slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_parent'  => 0,
				'post_content' => '',
				'post_author'  => $author,
			),
			true
		);

		if ( is_wp_error( $page_id ) || ! $page_id ) {
			continue;
		}

		update_post_meta( $page_id, '_wp_page_template', 'page-service.php' );
	}
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

	$position = 1;

	foreach ( hausmeister_get_primary_menu_slugs() as $slug ) {
		if ( 'leistungen' === $slug ) {
			if ( ! hausmeister_menu_has_leistungen_trigger( $menu_id ) ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'    => __( 'Leistungen', 'hausmeister-theme' ),
						'menu-item-url'      => '#leistungen',
						'menu-item-type'     => 'custom',
						'menu-item-status'   => 'publish',
						'menu-item-position' => $position,
						'menu-item-classes'  => 'leistungen-mega-menu',
					)
				);
			}
			$position++;
			continue;
		}

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

	hausmeister_sync_leistungen_menu_trigger( $menu_id );
}

/**
 * Ensure Leistungen menu items use the mega-menu trigger instead of a page link.
 *
 * @param int $menu_id Menu term ID.
 */
function hausmeister_sync_leistungen_menu_trigger( $menu_id ) {
	$menu_items = wp_get_nav_menu_items( $menu_id );
	if ( ! $menu_items ) {
		return;
	}

	foreach ( $menu_items as $item ) {
		if ( ! hausmeister_is_leistungen_menu_item( $item ) ) {
			continue;
		}

		$classes = array_filter( (array) $item->classes );
		if ( ! in_array( 'leistungen-mega-menu', $classes, true ) ) {
			$classes[] = 'leistungen-mega-menu';
		}

		if ( '#leistungen' === $item->url && 'custom' === $item->type && in_array( 'leistungen-mega-menu', $classes, true ) ) {
			continue;
		}

		wp_update_nav_menu_item(
			$menu_id,
			$item->ID,
			array(
				'menu-item-title'   => $item->title,
				'menu-item-url'     => '#leistungen',
				'menu-item-type'    => 'custom',
				'menu-item-status'  => 'publish',
				'menu-item-classes' => implode( ' ', $classes ),
			)
		);
	}
}

/**
 * Check whether the menu already has a Leistungen mega-menu trigger.
 *
 * @param int $menu_id Menu term ID.
 * @return bool
 */
function hausmeister_menu_has_leistungen_trigger( $menu_id ) {
	$menu_items = wp_get_nav_menu_items( $menu_id );
	if ( ! $menu_items ) {
		return false;
	}

	foreach ( $menu_items as $item ) {
		if ( hausmeister_is_leistungen_menu_item( $item ) ) {
			return true;
		}
	}

	return false;
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
