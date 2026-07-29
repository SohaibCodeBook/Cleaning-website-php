<?php
/**
 * Multi-step quote / contact form — helpers, shortcode, AJAX.
 *
 * Reusable via:
 *   hausmeister_render_quote_form();
 *   [hausmeister_quote_form]
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Property type options for the quote form.
 *
 * @return array<int, array{id:string,label:string,icon:string}>
 */
function hausmeister_get_quote_property_types() {
	$types = array(
		array(
			'id'    => 'wohnimmobilie',
			'label' => __( 'Wohnimmobilie', 'hausmeister-theme' ),
			'icon'  => 'fa-solid fa-house',
		),
		array(
			'id'    => 'buero',
			'label' => __( 'Bürogebäude', 'hausmeister-theme' ),
			'icon'  => 'fa-solid fa-building',
		),
		array(
			'id'    => 'gewerbe',
			'label' => __( 'Gewerbeimmobilie', 'hausmeister-theme' ),
			'icon'  => 'fa-solid fa-store',
		),
		array(
			'id'    => 'weg',
			'label' => __( 'WEG / Eigentümergemeinschaft', 'hausmeister-theme' ),
			'icon'  => 'fa-solid fa-people-roof',
		),
		array(
			'id'    => 'sonstiges',
			'label' => __( 'Sonstiges', 'hausmeister-theme' ),
			'icon'  => 'fa-solid fa-ellipsis',
		),
	);

	/**
	 * Filter property types shown in the quote form.
	 *
	 * @param array $types Property type definitions.
	 */
	return apply_filters( 'hausmeister_quote_property_types', $types );
}

/**
 * Step labels for the quote form stepper.
 *
 * @return string[]
 */
function hausmeister_get_quote_form_steps() {
	return array(
		1 => __( 'Leistung wählen', 'hausmeister-theme' ),
		2 => __( 'Objektdetails', 'hausmeister-theme' ),
		3 => __( 'Ihre Daten', 'hausmeister-theme' ),
		4 => __( 'Zusammenfassung', 'hausmeister-theme' ),
	);
}

/**
 * Render the multi-step quote form.
 *
 * @param array $args {
 *     Optional. Arguments.
 *     @type string $id    Unique form instance id (HTML id prefix).
 *     @type string $title Card heading.
 * }
 * @return void
 */
function hausmeister_render_quote_form( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'    => 'hausmeister-quote-form',
			'title' => __( 'Nachricht senden', 'hausmeister-theme' ),
		)
	);

	get_template_part(
		'template-parts/quote',
		'form',
		array(
			'form_id' => sanitize_html_class( $args['id'] ),
			'title'   => $args['title'],
		)
	);
}

/**
 * Shortcode: [hausmeister_quote_form title="Nachricht senden" id="my-form"]
 *
 * @param array|string $atts Shortcode attributes.
 * @return string
 */
function hausmeister_quote_form_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'id'    => 'hausmeister-quote-form',
			'title' => __( 'Nachricht senden', 'hausmeister-theme' ),
		),
		$atts,
		'hausmeister_quote_form'
	);

	ob_start();
	hausmeister_render_quote_form( $atts );
	return ob_get_clean();
}
add_shortcode( 'hausmeister_quote_form', 'hausmeister_quote_form_shortcode' );

/**
 * AJAX handler for multi-step quote form (email recipient set later via Customizer).
 */
function hausmeister_handle_quote_form() {
	check_ajax_referer( 'hausmeister_contact_nonce', 'nonce' );

	$name           = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email          = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone          = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$subject        = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message        = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$property_type  = isset( $_POST['property_type'] ) ? sanitize_text_field( wp_unslash( $_POST['property_type'] ) ) : '';
	$property_size  = isset( $_POST['property_size'] ) ? sanitize_text_field( wp_unslash( $_POST['property_size'] ) ) : '';
	$property_city  = isset( $_POST['property_city'] ) ? sanitize_text_field( wp_unslash( $_POST['property_city'] ) ) : '';
	$services_raw   = isset( $_POST['services'] ) ? wp_unslash( $_POST['services'] ) : array();

	$services = array();
	if ( is_array( $services_raw ) ) {
		foreach ( $services_raw as $service ) {
			$services[] = sanitize_text_field( $service );
		}
	} elseif ( is_string( $services_raw ) && $services_raw !== '' ) {
		foreach ( explode( ',', $services_raw ) as $service ) {
			$services[] = sanitize_text_field( $service );
		}
	}
	$services = array_filter( $services );

	if ( empty( $services ) ) {
		wp_send_json_error( array( 'message' => __( 'Bitte wählen Sie mindestens eine Leistung aus.', 'hausmeister-theme' ) ) );
	}

	if ( $property_type === '' ) {
		wp_send_json_error( array( 'message' => __( 'Bitte wählen Sie einen Objekttyp aus.', 'hausmeister-theme' ) ) );
	}

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Bitte füllen Sie alle Pflichtfelder aus.', 'hausmeister-theme' ) ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Bitte geben Sie eine gültige E-Mail-Adresse ein.', 'hausmeister-theme' ) ) );
	}

	$type_label = $property_type;
	foreach ( hausmeister_get_quote_property_types() as $type ) {
		if ( $type['id'] === $property_type ) {
			$type_label = $type['label'];
			break;
		}
	}

	$to      = site_data( 'contact_email' );
	$to      = is_email( $to ) ? $to : get_option( 'admin_email' );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	$body  = __( 'Neue Anfrage über das Angebotsformular', 'hausmeister-theme' ) . "\n\n";
	$body .= __( 'Leistungen', 'hausmeister-theme' ) . ': ' . implode( ', ', $services ) . "\n";
	$body .= __( 'Objekttyp', 'hausmeister-theme' ) . ': ' . $type_label . "\n";
	if ( $property_size !== '' ) {
		$body .= __( 'Größe', 'hausmeister-theme' ) . ': ' . $property_size . " m²\n";
	}
	if ( $property_city !== '' ) {
		$body .= __( 'Ort', 'hausmeister-theme' ) . ': ' . $property_city . "\n";
	}
	$body .= "\n";
	$body .= __( 'Name', 'hausmeister-theme' ) . ": {$name}\n";
	$body .= __( 'E-Mail', 'hausmeister-theme' ) . ": {$email}\n";
	$body .= __( 'Telefon', 'hausmeister-theme' ) . ": {$phone}\n";
	$body .= __( 'Betreff', 'hausmeister-theme' ) . ": {$subject}\n\n";
	$body .= __( 'Nachricht', 'hausmeister-theme' ) . ":\n{$message}";

	$mail_subject = '[Anfrage] ' . ( $subject !== '' ? $subject : implode( ', ', array_slice( $services, 0, 2 ) ) );

	$sent = wp_mail( $to, $mail_subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( 'Vielen Dank! Ihre Anfrage wurde erfolgreich gesendet.', 'hausmeister-theme' ) ) );
	}

	wp_send_json_error( array( 'message' => __( 'Beim Senden ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.', 'hausmeister-theme' ) ) );
}
add_action( 'wp_ajax_hausmeister_quote', 'hausmeister_handle_quote_form' );
add_action( 'wp_ajax_nopriv_hausmeister_quote', 'hausmeister_handle_quote_form' );
