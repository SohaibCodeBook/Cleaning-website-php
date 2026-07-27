<?php
/**
 * Basic SEO meta tags (extensible later).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output basic meta description.
 */
function hausmeister_seo_meta() {
	if ( is_singular() ) {
		$excerpt = get_the_excerpt();
		if ( $excerpt ) {
			echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $excerpt ) ) . '">' . "\n";
		}
		return;
	}

	$description = site_data( 'meta_description' );
	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hausmeister_seo_meta', 1 );
