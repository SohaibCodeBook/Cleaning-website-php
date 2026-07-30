<?php
/**
 * Hausmeister Theme functions and definitions.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

define( 'HAUSMEISTER_THEME_VERSION', '1.4.4' );
define( 'HAUSMEISTER_THEME_DIR', get_template_directory() );
define( 'HAUSMEISTER_THEME_URI', get_template_directory_uri() );

/**
 * URL for a bundled theme image under assets/images/.
 *
 * @param string $relative_path Path relative to assets/images/.
 * @return string
 */
function hausmeister_theme_image( $relative_path ) {
	return HAUSMEISTER_THEME_URI . '/assets/images/' . ltrim( $relative_path, '/' );
}

require_once HAUSMEISTER_THEME_DIR . '/inc/customizer.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/service-pages.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/mega-menu.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/quote-form.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/logo.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/setup-wizard.php';
require_once HAUSMEISTER_THEME_DIR . '/inc/seo.php';

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
		'hausmeister-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
		array(),
		'5.3.3'
	);

	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
		array(),
		'6.5.1'
	);

	wp_enqueue_style(
		'hausmeister-theme-style',
		get_stylesheet_uri(),
		array( 'bootstrap', 'font-awesome' ),
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
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
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
