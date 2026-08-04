<?php
/**
 * Hausmeister Theme functions and definitions.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

define( 'HAUSMEISTER_THEME_VERSION', '1.6.5' );
define( 'HAUSMEISTER_THEME_DIR', get_template_directory() );
define( 'HAUSMEISTER_THEME_URI', get_template_directory_uri() );

/**
 * URL for a bundled theme image under assets/images/.
 *
 * @param string $relative_path Path relative to assets/images/.
 * @return string
 */
function hausmeister_theme_image( $relative_path ) {
	$parts = array_map( 'rawurlencode', explode( '/', str_replace( '\\', '/', ltrim( $relative_path, '/' ) ) ) );
	return HAUSMEISTER_THEME_URI . '/assets/images/' . implode( '/', $parts );
}

/**
 * Max number of work-gallery Customizer image slots.
 *
 * @return int
 */
function hausmeister_gallery_slot_count() {
	return 20;
}

/**
 * Relative path of the bundled work-gallery seed folder under assets/images/.
 *
 * @return string
 */
function hausmeister_work_gallery_dir_relative() {
	return 'after images gallery';
}

/**
 * Bundled gallery seed filenames (stable order for defaults).
 *
 * @return string[]
 */
function hausmeister_work_gallery_seed_files() {
	return array(
		'WhatsApp Image 2026-07-30 at 3.13.51 PM.jpeg',
		'WhatsApp Image 2026-07-30 at 3.13.51 PM (1).jpeg',
		'WhatsApp Image 2026-07-30 at 3.13.51 PM (2).jpeg',
		'WhatsApp Image 2026-07-30 at 3.13.51 PM (3).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.36 PM.jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.36 PM (1).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.36 PM (2).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.36 PM (3).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.37 PM.jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.37 PM (1).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.37 PM (2).jpeg',
		'WhatsApp Image 2026-07-30 at 3.47.37 PM (3).jpeg',
	);
}

/**
 * Collect work gallery images from Customizer slots (empty slots stay hidden).
 * Layout spans stay the same as before (wide / tall / square / featured).
 *
 * @return array<int, array{url:string, width:int, height:int, span:string, alt:string}>
 */
function hausmeister_get_work_gallery_images() {
	$slots  = hausmeister_gallery_slot_count();
	$filled = array();

	for ( $i = 1; $i <= $slots; $i++ ) {
		$value = page_home( "gallery_{$i}_image" );
		$url   = '';
		$w     = 0;
		$h     = 0;

		if ( is_numeric( $value ) ) {
			$meta = wp_get_attachment_image_src( (int) $value, 'full' );
			if ( $meta ) {
				$url = $meta[0];
				$w   = (int) $meta[1];
				$h   = (int) $meta[2];
			}
		} elseif ( is_string( $value ) && $value !== '' ) {
			$url      = $value;
			$theme_uri = HAUSMEISTER_THEME_URI . '/assets/images/';
			if ( 0 === strpos( $url, $theme_uri ) ) {
				$rel  = rawurldecode( substr( $url, strlen( $theme_uri ) ) );
				$path = HAUSMEISTER_THEME_DIR . '/assets/images/' . $rel;
				if ( is_file( $path ) ) {
					$size = @getimagesize( $path );
					if ( $size ) {
						$w = (int) $size[0];
						$h = (int) $size[1];
					}
				}
			}
		}

		if ( $url === '' ) {
			continue;
		}

		$filled[] = array(
			'url'    => $url,
			'width'  => $w,
			'height' => $h,
			'alt'    => sprintf(
				/* translators: %d: gallery image number */
				__( 'Arbeitsbeispiel %d', 'hausmeister-theme' ),
				count( $filled ) + 1
			),
		);
	}

	$count  = count( $filled );
	$images = array();
	foreach ( $filled as $index => $item ) {
		$ratio = $item['height'] > 0 ? ( $item['width'] / $item['height'] ) : 1;

		if ( $ratio >= 1.35 ) {
			$span = 'wide';
		} elseif ( $ratio <= 0.75 ) {
			$span = 'tall';
		} else {
			$span = 'square';
		}

		if ( 0 === ( $index % 5 ) && $index > 0 && $count >= 6 ) {
			$span = 'featured';
		}

		$item['span'] = $span;
		$images[]     = $item;
	}

	return $images;
}

require_once HAUSMEISTER_THEME_DIR . '/inc/customizer.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/service-pages.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/mega-menu.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/quote-form.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/logo.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/cookie-policy.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/setup-wizard.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/seo.php';

/**
 * One-time: apply Sascha Becker photo + attribution on Warum-wir (home + Über uns).
 * Clears older Customizer overrides that still pointed at why-us.jpg / Unser Team.
 */
function hausmeister_migrate_sascha_why_us() {
	if ( get_option( 'hausmeister_sascha_why_v2' ) === '1' ) {
		return;
	}

	$image  = hausmeister_theme_image( 'Sascha Becker.jpeg' );
	$author = '— Sascha Becker';

	set_theme_mod( 'hausmeister_why_image', $image );
	set_theme_mod( 'hausmeister_about_why_image', $image );
	set_theme_mod( 'hausmeister_why_quote_author', $author );
	set_theme_mod( 'hausmeister_about_why_quote_author', $author );

	update_option( 'hausmeister_sascha_why_v2', '1' );
}
add_action( 'after_setup_theme', 'hausmeister_migrate_sascha_why_us', 20 );

/**
 * One-time: apply updated homepage hero + stats copy.
 */
function hausmeister_migrate_home_hero_stats_v1() {
	if ( get_option( 'hausmeister_home_hero_stats_v1' ) === '1' ) {
		return;
	}

	$defaults = hausmeister_get_defaults();
	$keys     = array(
		'hero_line_1',
		'hero_line_2',
		'hero_line_3',
		'hero_subtitle',
		'hero_trust_1',
		'hero_trust_2',
		'hero_trust_3',
		'stat_1_suffix',
		'stat_3_label',
		'stat_4_suffix',
	);

	foreach ( $keys as $key ) {
		if ( isset( $defaults[ $key ] ) ) {
			set_theme_mod( 'hausmeister_' . $key, $defaults[ $key ] );
		}
	}

	update_option( 'hausmeister_home_hero_stats_v1', '1' );
}
add_action( 'after_setup_theme', 'hausmeister_migrate_home_hero_stats_v1', 21 );

/**
 * One-time: ensure Cookie-Richtlinie page exists with editable default content.
 */
function hausmeister_migrate_cookie_policy_page_v1() {
	if ( get_option( 'hausmeister_cookie_policy_page_v1' ) === '1' ) {
		return;
	}

	$existing = get_page_by_path( 'cookie-richtlinie', OBJECT, 'page' );
	$author   = get_current_user_id();
	$author   = $author ? $author : 1;

	if ( ! $existing ) {
		$page_id = wp_insert_post(
			array(
				'post_title'   => 'Cookie-Richtlinie',
				'post_name'    => 'cookie-richtlinie',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => function_exists( 'hausmeister_get_default_cookie_policy_html' ) ? hausmeister_get_default_cookie_policy_html() : '',
				'post_author'  => $author,
			),
			true
		);
		if ( ! is_wp_error( $page_id ) && $page_id ) {
			update_post_meta( $page_id, '_wp_page_template', 'page-cookie-richtlinie.php' );
		}
	} else {
		update_post_meta( $existing->ID, '_wp_page_template', 'page-cookie-richtlinie.php' );
		if ( '' === trim( (string) $existing->post_content ) && function_exists( 'hausmeister_get_default_cookie_policy_html' ) ) {
			wp_update_post(
				array(
					'ID'           => $existing->ID,
					'post_content' => hausmeister_get_default_cookie_policy_html(),
				)
			);
		}
	}

	update_option( 'hausmeister_cookie_policy_page_v1', '1' );
}
add_action( 'init', 'hausmeister_migrate_cookie_policy_page_v1', 20 );

/**
 * Theme setup.
 */
function hausmeister_theme_setup() {
	load_theme_textdomain( 'hausmeister-theme', HAUSMEISTER_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Hauptmenü', 'hausmeister-theme' ),
		'footer'  => __( 'Footer-Menü', 'hausmeister-theme' ),
	) );
}
add_action( 'after_setup_theme', 'hausmeister_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function hausmeister_theme_enqueue_assets() {
	wp_enqueue_style(
		'hausmeister-fonts',
		HAUSMEISTER_THEME_URI . '/assets/css/fonts.css',
		array(),
		HAUSMEISTER_THEME_VERSION
	);

	wp_enqueue_style(
		'bootstrap',
		HAUSMEISTER_THEME_URI . '/assets/vendor/bootstrap/bootstrap.min.css',
		array(),
		'5.3.3'
	);

	wp_enqueue_style(
		'font-awesome',
		HAUSMEISTER_THEME_URI . '/assets/vendor/fontawesome/css/all.min.css',
		array(),
		'6.5.1'
	);

	wp_enqueue_style(
		'hausmeister-theme-style',
		get_stylesheet_uri(),
		array( 'hausmeister-fonts', 'bootstrap', 'font-awesome' ),
		HAUSMEISTER_THEME_VERSION
	);

	wp_enqueue_style(
		'hausmeister-google-reviews',
		HAUSMEISTER_THEME_URI . '/assets/css/google-reviews.css',
		array( 'hausmeister-theme-style' ),
		HAUSMEISTER_THEME_VERSION
	);

	wp_enqueue_style(
		'hausmeister-mega-menu',
		HAUSMEISTER_THEME_URI . '/assets/css/mega-menu.css',
		array( 'hausmeister-theme-style' ),
		HAUSMEISTER_THEME_VERSION
	);

	wp_enqueue_style(
		'hausmeister-quote-form',
		HAUSMEISTER_THEME_URI . '/assets/css/quote-form.css',
		array( 'hausmeister-theme-style' ),
		HAUSMEISTER_THEME_VERSION
	);

	if ( is_page_template( 'page-service.php' ) || hausmeister_get_service_index_from_page() ) {
		wp_enqueue_style(
			'hausmeister-service-page',
			HAUSMEISTER_THEME_URI . '/assets/css/service-page.css',
			array( 'hausmeister-theme-style' ),
			HAUSMEISTER_THEME_VERSION
		);
	}

	wp_enqueue_script(
		'bootstrap',
		HAUSMEISTER_THEME_URI . '/assets/vendor/bootstrap/bootstrap.bundle.min.js',
		array(),
		'5.3.3',
		true
	);

	wp_enqueue_script(
		'hausmeister-main',
		HAUSMEISTER_THEME_URI . '/assets/js/main.js',
		array(),
		HAUSMEISTER_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'hausmeister-quote-form',
		HAUSMEISTER_THEME_URI . '/assets/js/quote-form.js',
		array( 'hausmeister-main' ),
		HAUSMEISTER_THEME_VERSION,
		true
	);

	wp_localize_script( 'hausmeister-main', 'hausmeisterAjax', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'hausmeister_contact_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'hausmeister_theme_enqueue_assets' );

/**
 * Custom nav walker with services mega menu support.
 */
class Hausmeister_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="sub-menu">';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_mega    = 0 === (int) $depth && hausmeister_is_leistungen_menu_item( $item );

		if ( $has_mega ) {
			$classes[] = 'menu-item-has-mega';
		}

		$class_names = implode( ' ', array_map( 'sanitize_html_class', array_filter( $classes ) ) );
		$output     .= '<li class="' . esc_attr( $class_names ) . '">';

		$link_classes = 'nav-link';
		if ( $has_mega ) {
			$link_classes .= ' nav-link--mega';
		}

		$link_url = $has_mega ? '#leistungen' : $item->url;
		$atts     = ' class="' . esc_attr( $link_classes ) . '" href="' . esc_url( $link_url ) . '"';
		$atts    .= $has_mega ? ' aria-haspopup="true" aria-expanded="false" role="button"' : '';

		$output .= '<a' . $atts . '>' . esc_html( $item->title );
		if ( $has_mega ) {
			$output .= hausmeister_mega_menu_chevron_svg();
		}
		$output .= '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === (int) $depth && hausmeister_is_leistungen_menu_item( $item ) ) {
			$output .= '<div class="mega-menu-panel">';
			ob_start();
			hausmeister_render_services_mega_menu();
			$output .= ob_get_clean();
			$output .= '</div>';
		}

		$output .= '</li>';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}
}

/**
 * Output a single fallback nav item.
 *
 * @param string $slug Page slug.
 * @param string $label Link label.
 */
function hausmeister_render_fallback_nav_item( $slug, $label ) {
	if ( 'leistungen' === $slug ) {
		echo '<li class="menu-item-has-mega leistungen-mega-menu">';
		echo '<a href="#leistungen" class="nav-link nav-link--mega" aria-haspopup="true" aria-expanded="false" role="button">';
		echo esc_html( $label );
		echo hausmeister_mega_menu_chevron_svg();
		echo '</a>';
		echo '<div class="mega-menu-panel">';
		hausmeister_render_services_mega_menu();
		echo '</div>';
		echo '</li>';
		return;
	}

	$page = get_page_by_path( $slug );
	$url  = $page ? get_permalink( $page ) : home_url( '/' );

	echo '<li><a class="nav-link" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
}

/**
 * Fallback primary menu when none is assigned.
 */
function hausmeister_fallback_menu() {
	$pages = array(
		'startseite' => __( 'Startseite', 'hausmeister-theme' ),
		'leistungen' => __( 'Leistungen', 'hausmeister-theme' ),
		'ueber-uns'  => __( 'Über uns', 'hausmeister-theme' ),
		'kontakt'    => __( 'Kontakt', 'hausmeister-theme' ),
	);

	echo '<ul class="nav-list">';
	foreach ( hausmeister_get_primary_menu_slugs() as $slug ) {
		hausmeister_render_fallback_nav_item( $slug, $pages[ $slug ] );
	}
	echo '</ul>';
}

/**
 * AJAX contact form handler.
 */
function hausmeister_handle_contact_form() {
	check_ajax_referer( 'hausmeister_contact_nonce', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Bitte füllen Sie alle Pflichtfelder aus.', 'hausmeister-theme' ) ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Bitte geben Sie eine gültige E-Mail-Adresse ein.', 'hausmeister-theme' ) ) );
	}

	$to      = site_data( 'contact_email' );
	$to      = is_email( $to ) ? $to : get_option( 'admin_email' );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	$body  = "Name: {$name}\n";
	$body .= "E-Mail: {$email}\n";
	$body .= "Telefon: {$phone}\n";
	$body .= "Betreff: {$subject}\n\n";
	$body .= "Nachricht:\n{$message}";

	$sent = wp_mail( $to, '[Kontakt] ' . ( $subject ?: 'Neue Anfrage' ), $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.', 'hausmeister-theme' ) ) );
	}

	wp_send_json_error( array( 'message' => __( 'Beim Senden ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.', 'hausmeister-theme' ) ) );
}
add_action( 'wp_ajax_hausmeister_contact', 'hausmeister_handle_contact_form' );
add_action( 'wp_ajax_nopriv_hausmeister_contact', 'hausmeister_handle_contact_form' );

/**
 * Force the Complianz cookie banner even when no warning is required.
 */
add_filter( 'cmplz_site_needs_cookiewarning', 'cmplz_force_banner' );
function cmplz_force_banner( $required ) {
	return true;
}
