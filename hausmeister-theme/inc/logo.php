<?php
/**
 * Logo output helper.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output site logo or company name text.
 */
function hausmeister_the_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	$custom_logo = site_data( 'custom_logo_url' );
	if ( $custom_logo ) {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '">';
		echo '<img src="' . esc_url( $custom_logo ) . '" alt="' . esc_attr( site_data( 'company_name' ) ) . '">';
		echo '</a>';
		return;
	}

	echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo-text">';
	echo esc_html( site_data( 'company_name' ) );
	echo '</a>';
}
