<?php
/**
 * Theme Customizer settings and helper functions.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for all theme settings.
 *
 * @return array
 */
function hausmeister_get_defaults() {
	return array(
		// Global / Contact.
		'company_name'       => 'Ihr Hausmeisterservice',
		'address'            => 'Musterstraße 1, 12345 Musterstadt',
		'phone'              => '+49 123 456789',
		'contact_email'      => 'info@beispiel.de',
		'meta_description'   => 'Professionelle Hausmeistertätigkeiten, Reinigung, Grünanlagenpflege, Entrümpelungen und Winterdienst in Ihrer Region.',
		'custom_logo_url'    => '',
		'header_cta_text'    => 'Jetzt anrufen',
		'header_cta_phone'   => '092317960386',
		'footer_about'       => 'Ihr zuverlässiger Partner für Hausmeistertätigkeiten, Reinigung, Grünanlagenpflege und Winterdienst — professionell und termingerecht.',
		'footer_copyright'   => 'Alle Rechte vorbehalten.',
		'social_facebook'    => '',
		'social_instagram'   => '',
		'social_linkedin'    => '',

		// Homepage — Hero.
		'hero_badge'              => 'Immobilienbetreuung',
		'hero_line_1'             => 'Gepflegte Immobilien',
		'hero_line_2'             => 'Zuverlässiger Service',
		'hero_line_3'             => 'Starke Leistung',
		'hero_subtitle'           => 'Professionelle Hausmeistertätigkeiten, Reinigung, Grünanlagenpflege, Entrümpelungen und Winterdienst — alles aus einer Hand für Gewerbe- und Wohnimmobilien.',
		'hero_btn_primary_text'   => 'Kostenlos beraten lassen',
		'hero_btn_primary_url'    => '/kontakt/',
		'hero_btn_secondary_text' => 'Leistungen entdecken',
		'hero_btn_secondary_url'  => '/leistungen/',
		'hero_trust_1'            => 'Gewerbe & Wohnen',
		'hero_trust_2'            => 'Termingerecht',
		'hero_trust_3'            => '24/7 Notdienst',
		'hero_image'              => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1280&q=80',

		// Homepage — Stats.
		'stat_1_target'   => '50',
		'stat_1_suffix'   => '+',
		'stat_1_prefix'   => '',
		'stat_1_display'  => '',
		'stat_1_animate'  => '1',
		'stat_1_label'    => 'Betreute Objekte',
		'stat_2_target'   => '100',
		'stat_2_suffix'   => '%',
		'stat_2_prefix'   => '',
		'stat_2_display'  => '',
		'stat_2_animate'  => '1',
		'stat_2_label'    => 'Kundenzufriedenheit',
		'stat_3_target'   => '',
		'stat_3_suffix'   => '',
		'stat_3_prefix'   => '',
		'stat_3_display'  => '24/7',
		'stat_3_animate'  => '0',
		'stat_3_label'    => 'Verfügbarkeit',
		'stat_4_target'   => '5',
		'stat_4_suffix'   => '+',
		'stat_4_prefix'   => '',
		'stat_4_display'  => '',
		'stat_4_animate'  => '1',
		'stat_4_label'    => 'Leistungsbereiche',

		// Homepage — Services section.
		'services_section_label' => 'Unsere Leistungen',
		'services_heading'       => 'Ganzheitliche Immobilienbetreuung für Ihre Liegenschaft',
		'services_subheading'    => 'Umfassende Dienstleistungen, individuell auf Ihre Anforderungen zugeschnitten — von der Hausmeisterbetreuung bis zum Winterdienst.',
		'service_link_text'      => 'Mehr erfahren',

		// Service 1: Hausmeistertätigkeiten.
		'service_1_icon'        => 'fa-solid fa-building-user',
		'service_1_title'       => 'Hausmeistertätigkeiten',
		'service_1_description' => 'Zuverlässige Betreuung Ihrer Immobilie: Kontrollgänge, Kleinreparaturen, Müllentsorgung und Ansprechpartner für Mieter und Eigentümer.',
		'service_1_tags'        => 'Kontrollgänge, Kleinreparaturen, Müllentsorgung',
		'service_1_url'         => '/leistungen/',

		// Service 2: Reinigung & Instandhaltung.
		'service_2_icon'        => 'fa-solid fa-broom',
		'service_2_title'       => 'Reinigung & Instandhaltung',
		'service_2_description' => 'Treppenhäuser, Fenster, Dachrinnen, PV-Anlagen, Fassadenreinigung und Parkplätze — hygienisch einwandfrei und termingerecht.',
		'service_2_tags'        => 'Treppenhäuser, Fensterreinigung, Fassadenreinigung',
		'service_2_url'         => '/leistungen/',

		// Service 3: Grünanlagenpflege.
		'service_3_icon'        => 'fa-solid fa-leaf',
		'service_3_title'       => 'Grünanlagenpflege',
		'service_3_description' => 'Fachgerechte Pflege von Außenanlagen, Rasenflächen, Hecken und Beeten — für einen gepflegten ersten Eindruck zu jeder Jahreszeit.',
		'service_3_tags'        => 'Rasenmähen, Heckenschnitt, Unkrautbeseitigung',
		'service_3_url'         => '/leistungen/',

		// Service 4: Entrümpelungen.
		'service_4_icon'        => 'fa-solid fa-boxes-stacked',
		'service_4_title'       => 'Entrümpelungen',
		'service_4_description' => 'Schnelle und diskrete Entrümpelung von Wohnungen, Kellern, Dachböden und Gewerbeflächen — inklusive fachgerechter Entsorgung.',
		'service_4_tags'        => 'Wohnungen, Keller & Dachboden, Entsorgung',
		'service_4_url'         => '/leistungen/',

		// Service 5: Winterdienst.
		'service_5_icon'        => 'fa-solid fa-snowflake',
		'service_5_title'       => 'Winterdienst',
		'service_5_description' => 'Zuverlässiger Räum- und Streudienst für Geh- und Fahrwege — rund um die Uhr, damit Ihre Verkehrssicherungspflicht erfüllt bleibt.',
		'service_5_tags'        => 'Schneeräumung, Streuarbeiten, Glättebeseitigung',
		'service_5_url'         => '/leistungen/',

		// Homepage — Why Us.
		'why_section_label'   => 'Warum wir',
		'features_heading'    => 'Drei Säulen unseres Erfolgs',
		'features_subheading'   => 'Seit Beginn setzen wir auf Qualität, Transparenz und Zuverlässigkeit. Erfahren Sie, was uns auszeichnet und Ihre Immobilie in besten Händen hält.',
		'why_image'             => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=1280&q=80',
		'why_quote_author'      => '— Unser Team',

		'feature_1_icon'        => 'fa-solid fa-award',
		'feature_1_title'       => 'Qualität ohne Kompromisse',
		'feature_1_description' => 'Regelmäßige Qualitätskontrollen, geschultes Fachpersonal und dokumentierte Abläufe sichern ein gleichbleibend hohes Serviceniveau.',
		'feature_1_quote'       => 'Wir behandeln Ihre Immobilie, als wäre sie unsere eigene.',

		'feature_2_icon'        => 'fa-solid fa-leaf',
		'feature_2_title'       => 'Nachhaltiges Handeln',
		'feature_2_description' => 'Umweltbewusste Reinigungsmittel, ressourcenschonende Verfahren und sorgfältiger Umgang mit Ihrer Liegenschaft.',
		'feature_2_quote'       => 'Nachhaltigkeit ist kein Trend – sondern unsere Überzeugung.',

		'feature_3_icon'        => 'fa-solid fa-handshake',
		'feature_3_title'       => 'Transparente Partnerschaft',
		'feature_3_description' => 'Klare Leistungsverzeichnisse und ein fester Ansprechpartner – Sie behalten jederzeit den Überblick.',
		'feature_3_quote'       => 'Vertrauen entsteht durch Transparenz und offene Kommunikation.',

		'feature_4_icon'        => 'fa-solid fa-star',
		'feature_4_title'       => 'Hohe Qualität',
		'feature_4_description' => 'Gründliche Arbeit und gepflegtes Erscheinungsbild Ihrer Immobilie.',
		'feature_4_quote'       => '',

		// Homepage — Before & After.
		'ba_section_label' => 'Vorher & Nachher',
		'ba_heading'       => 'Transformationen, die sprechen',
		'ba_subheading'    => 'Wählen Sie eine Leistung und ziehen Sie den Regler auf den Karten — so sehen Sie den Unterschied sofort.',

		'ba_1_category'     => 'treppenhaus',
		'ba_1_title'        => 'Treppenhausreinigung',
		'ba_1_description'  => 'Vom staubigen Flur zum hygienisch sauberen Treppenhaus — gründlich und termingerecht.',
		'ba_1_location'     => 'Mehrfamilienhaus',
		'ba_1_before'       => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=1400&q=85',
		'ba_1_after'        => 'https://images.unsplash.com/photo-1600585154340-be6162a9a0c?w=1400&q=85',

		'ba_2_category'     => 'gruen',
		'ba_2_title'        => 'Grünanlagenpflege',
		'ba_2_description'  => 'Überwucherte Flächen werden zu gepflegten Außenanlagen mit klaren Linien.',
		'ba_2_location'     => 'Gewerbeobjekt',
		'ba_2_before'       => 'https://images.unsplash.com/photo-1592150621744-8487f23381ac?w=1400&q=85',
		'ba_2_after'        => 'https://images.unsplash.com/photo-1598908324228-86d378765913?w=1400&q=85',

		'ba_3_category'     => 'fassade',
		'ba_3_title'        => 'Fassadenreinigung',
		'ba_3_description'  => 'Verschmutzte Fassaden erstrahlen wieder in sauberer, gepflegter Optik.',
		'ba_3_location'     => 'Bürogebäude',
		'ba_3_before'       => 'https://images.unsplash.com/photo-1449844908441-8829872d2607?w=1400&q=85',
		'ba_3_after'        => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1400&q=85',

		'ba_4_category'     => 'glas',
		'ba_4_title'        => 'Glasreinigung',
		'ba_4_description'  => 'Schlierenfreie Fenster und Glasflächen für mehr Licht und Transparenz.',
		'ba_4_location'     => 'Wohn- & Gewerbeobjekt',
		'ba_4_before'       => 'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?w=1400&q=85',
		'ba_4_after'        => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1400&q=85',

		'ba_5_category'     => 'winter',
		'ba_5_title'        => 'Winterdienst',
		'ba_5_description'  => 'Verschneite Wege werden sicher geräumt und gestreut — rechtssicher und zuverlässig.',
		'ba_5_location'     => 'Zufahrt & Gehweg',
		'ba_5_before'       => 'https://images.unsplash.com/photo-1418665086829-2484e7913564?w=1400&q=85',
		'ba_5_after'        => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1400&q=85',

		// Homepage — CTA.
		'cta_heading'  => 'Bereit für ein unverbindliches Angebot?',
		'cta_text'     => 'Kontaktieren Sie uns noch heute — wir beraten Sie gerne persönlich zu allen Leistungen.',
		'cta_btn_text' => 'Kontakt aufnehmen',
		'cta_btn_url'  => '/kontakt/',

		// Leistungen page.
		'services_page_title'    => 'Unsere Leistungen',
		'services_page_subtitle' => 'Entdecken Sie unser umfassendes Leistungsspektrum für Ihre Immobilie.',

		// Über uns page.
		'about_page_title'    => 'Über uns',
		'about_page_subtitle' => 'Ihr Partner für professionelle Immobilienbetreuung.',
		'about_intro_text'    => 'Wir sind ein erfahrenes Team im Bereich Hausmeistertätigkeiten, Reinigung, Grünanlagenpflege und Winterdienst. Mit Leidenschaft und Fachkompetenz sorgen wir dafür, dass Ihre Immobilie stets in bestem Zustand bleibt. Vertrauen, Qualität und Zuverlässigkeit sind die Grundpfeiler unserer Arbeit.',
		'about_value_1_icon'        => 'fa-solid fa-users',
		'about_value_1_title'       => 'Erfahrenes Team',
		'about_value_1_description' => 'Qualifizierte Fachkräfte mit langjähriger Erfahrung in der Immobilienbetreuung.',
		'about_value_2_icon'        => 'fa-solid fa-leaf',
		'about_value_2_title'       => 'Nachhaltig & sorgfältig',
		'about_value_2_description' => 'Umweltbewusste Arbeitsweise und sorgfältiger Umgang mit Ihrer Immobilie.',
		'about_value_3_icon'        => 'fa-solid fa-map-location-dot',
		'about_value_3_title'       => 'Regional verwurzelt',
		'about_value_3_description' => 'Schnelle Reaktionszeiten durch unsere regionale Präsenz in Ihrer Nähe.',

		// Kontakt page.
		'contact_page_title'       => 'Kontakt',
		'contact_page_subtitle'    => 'Wir freuen uns auf Ihre Anfrage — schreiben Sie uns oder rufen Sie uns an.',
		'contact_info_text'      => 'Nutzen Sie das Formular oder kontaktieren Sie uns direkt per Telefon oder E-Mail. Wir melden uns schnellstmöglich bei Ihnen.',
		'contact_form_submit_text' => 'Nachricht senden',
	);
}

/**
 * Resolve a theme URL (relative or absolute).
 *
 * @param string $path URL or path from Customizer.
 * @return string
 */
function hausmeister_theme_url( $path ) {
	if ( empty( $path ) ) {
		return home_url( '/' );
	}
	if ( preg_match( '#^https?://#i', $path ) ) {
		return $path;
	}
	return home_url( $path );
}

/**
 * Build a tel: link from a phone number.
 *
 * @param string $phone Phone number.
 * @return string
 */
function hausmeister_tel_link( $phone ) {
	$phone = is_string( $phone ) ? trim( $phone ) : '';
	if ( $phone === '' ) {
		return '';
	}
	$clean = preg_replace( '/[^\d+]/', '', $phone );
	return 'tel:' . $clean;
}

/**
 * Get global site setting.
 *
 * @param string $key Setting key.
 * @return string
 */
function site_data( $key ) {
	$defaults = hausmeister_get_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	$value    = get_theme_mod( 'hausmeister_' . $key, $default );
	return is_string( $value ) ? $value : (string) $value;
}

/**
 * Get homepage setting.
 *
 * @param string $key     Setting key (without prefix).
 * @param string $default Optional override default.
 * @return string
 */
function page_home( $key, $default = '' ) {
	$defaults = hausmeister_get_defaults();
	$fallback = $default !== '' ? $default : ( isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
	$value    = get_theme_mod( 'hausmeister_' . $key, $fallback );
	return is_string( $value ) ? $value : (string) $value;
}

/**
 * Get Leistungen page setting.
 *
 * @param string $key     Setting key (without prefix).
 * @param string $default Optional override default.
 * @return string
 */
function page_services( $key, $default = '' ) {
	$map = array(
		'page_title'    => 'services_page_title',
		'page_subtitle' => 'services_page_subtitle',
	);
	$setting_key = isset( $map[ $key ] ) ? $map[ $key ] : $key;
	return page_home( $setting_key, $default );
}

/**
 * Get Über uns page setting.
 *
 * @param string $key     Setting key (without prefix).
 * @param string $default Optional override default.
 * @return string
 */
function page_about( $key, $default = '' ) {
	$map = array(
		'page_title'    => 'about_page_title',
		'page_subtitle' => 'about_page_subtitle',
		'intro_text'    => 'about_intro_text',
	);
	$setting_key = $key;
	if ( preg_match( '/^value_(\d+)_(.+)$/', $key, $matches ) ) {
		$setting_key = 'about_value_' . $matches[1] . '_' . $matches[2];
	} elseif ( isset( $map[ $key ] ) ) {
		$setting_key = $map[ $key ];
	}
	return page_home( $setting_key, $default );
}

/**
 * Get Kontakt page setting.
 *
 * @param string $key     Setting key (without prefix).
 * @param string $default Optional override default.
 * @return string
 */
function page_contact( $key, $default = '' ) {
	$map = array(
		'page_title'       => 'contact_page_title',
		'page_subtitle'    => 'contact_page_subtitle',
		'info_text'        => 'contact_info_text',
		'form_submit_text' => 'contact_form_submit_text',
	);
	$setting_key = isset( $map[ $key ] ) ? $map[ $key ] : $key;
	return page_home( $setting_key, $default );
}

/**
 * Parse comma-separated tags into an array.
 *
 * @param string $raw Comma-separated tag string.
 * @return string[]
 */
function hausmeister_parse_tags( $raw ) {
	if ( ! is_string( $raw ) || $raw === '' ) {
		return array();
	}
	$parts = array_map( 'trim', explode( ',', $raw ) );
	return array_values( array_filter( $parts ) );
}

/**
 * Resolve a Customizer image setting (URL or attachment ID).
 *
 * @param string $key Theme mod key without prefix.
 * @return string
 */
function hausmeister_get_image_url( $key ) {
	$value = page_home( $key );
	if ( is_numeric( $value ) ) {
		$url = wp_get_attachment_image_url( (int) $value, 'full' );
		return $url ? $url : '';
	}
	return is_string( $value ) ? $value : '';
}

/**
 * Before/After filter tabs.
 *
 * @return array<string, string>
 */
function hausmeister_get_ba_filters() {
	return array(
		'all'         => __( 'Alle', 'hausmeister-theme' ),
		'treppenhaus' => __( 'Treppenhausreinigung', 'hausmeister-theme' ),
		'gruen'       => __( 'Grünanlagenpflege', 'hausmeister-theme' ),
		'fassade'     => __( 'Fassadenreinigung', 'hausmeister-theme' ),
		'glas'        => __( 'Glasreinigung', 'hausmeister-theme' ),
		'winter'      => __( 'Winterdienst', 'hausmeister-theme' ),
	);
}

/**
 * Get label for a before/after category slug.
 *
 * @param string $slug Category slug.
 * @return string
 */
function hausmeister_get_ba_category_label( $slug ) {
	$filters = hausmeister_get_ba_filters();
	return isset( $filters[ $slug ] ) ? $filters[ $slug ] : $slug;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function hausmeister_customize_register( $wp_customize ) {
	$defaults = hausmeister_get_defaults();

	$wp_customize->add_panel( 'hausmeister_panel', array(
		'title'    => __( 'Theme-Einstellungen', 'hausmeister-theme' ),
		'priority' => 30,
	) );

	// --- Global Contact ---
	$wp_customize->add_section( 'hausmeister_global', array(
		'title' => __( 'Globale Kontaktdaten', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	$global_fields = array(
		'company_name'     => __( 'Firmenname', 'hausmeister-theme' ),
		'address'          => __( 'Adresse', 'hausmeister-theme' ),
		'phone'            => __( 'Telefon', 'hausmeister-theme' ),
		'contact_email'    => __( 'E-Mail', 'hausmeister-theme' ),
		'meta_description' => __( 'Meta-Beschreibung (SEO)', 'hausmeister-theme' ),
		'custom_logo_url'  => __( 'Logo-URL (falls kein WP-Logo)', 'hausmeister-theme' ),
		'header_cta_text'   => __( 'Header-Anruf Button Text', 'hausmeister-theme' ),
		'header_cta_phone'  => __( 'Header-Anruf Telefonnummer', 'hausmeister-theme' ),
		'footer_about'     => __( 'Footer-Beschreibung', 'hausmeister-theme' ),
		'footer_copyright' => __( 'Footer-Copyright Text', 'hausmeister-theme' ),
	);

	foreach ( $global_fields as $key => $label ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => in_array( $key, array( 'contact_email' ), true ) ? 'sanitize_email' : ( in_array( $key, array( 'custom_logo_url' ), true ) ? 'esc_url_raw' : 'sanitize_text_field' ),
		) );
		$control_type = in_array( $key, array( 'footer_about', 'meta_description' ), true ) ? 'textarea' : 'text';
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $label,
			'section' => 'hausmeister_global',
			'type'    => $control_type,
		) );
	}

	// --- Social ---
	$wp_customize->add_section( 'hausmeister_social', array(
		'title' => __( 'Social Media', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'social_facebook', 'social_instagram', 'social_linkedin' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => ucfirst( str_replace( 'social_', '', $key ) ) . ' URL',
			'section' => 'hausmeister_social',
			'type'    => 'url',
		) );
	}

	// --- Homepage Hero ---
	$wp_customize->add_section( 'hausmeister_home_hero', array(
		'title' => __( 'Startseite — Hero', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	$hero_fields = array(
		'hero_badge'              => __( 'Badge-Text', 'hausmeister-theme' ),
		'hero_line_1'             => __( 'Headline Zeile 1', 'hausmeister-theme' ),
		'hero_line_2'             => __( 'Headline Zeile 2', 'hausmeister-theme' ),
		'hero_line_3'             => __( 'Headline Zeile 3', 'hausmeister-theme' ),
		'hero_subtitle'           => __( 'Untertitel', 'hausmeister-theme' ),
		'hero_btn_primary_text'   => __( 'Primär-Button Text', 'hausmeister-theme' ),
		'hero_btn_primary_url'    => __( 'Primär-Button URL', 'hausmeister-theme' ),
		'hero_btn_secondary_text' => __( 'Sekundär-Button Text', 'hausmeister-theme' ),
		'hero_btn_secondary_url'  => __( 'Sekundär-Button URL', 'hausmeister-theme' ),
		'hero_trust_1'            => __( 'Vertrauens-Badge 1', 'hausmeister-theme' ),
		'hero_trust_2'            => __( 'Vertrauens-Badge 2', 'hausmeister-theme' ),
		'hero_trust_3'            => __( 'Vertrauens-Badge 3', 'hausmeister-theme' ),
	);

	foreach ( $hero_fields as $key => $label ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
			'sanitize_callback' => strpos( $key, '_url' ) !== false ? 'esc_url_raw' : ( $key === 'hero_subtitle' ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $label,
			'section' => 'hausmeister_home_hero',
			'type'    => $key === 'hero_subtitle' ? 'textarea' : 'text',
		) );
	}

	$wp_customize->add_setting( 'hausmeister_hero_image', array(
		'default'           => $defaults['hero_image'],
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hausmeister_hero_image', array(
		'label'   => __( 'Hero-Bild', 'hausmeister-theme' ),
		'section' => 'hausmeister_home_hero',
	) ) );

	// --- Homepage Stats ---
	$wp_customize->add_section( 'hausmeister_home_stats', array(
		'title' => __( 'Startseite — Statistiken', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	for ( $s = 1; $s <= 4; $s++ ) {
		foreach ( array(
			"stat_{$s}_target"  => __( 'Zielwert (Zahl)', 'hausmeister-theme' ),
			"stat_{$s}_suffix"  => __( 'Suffix (z.B. + oder %)', 'hausmeister-theme' ),
			"stat_{$s}_prefix"  => __( 'Präfix', 'hausmeister-theme' ),
			"stat_{$s}_display" => __( 'Statischer Text (z.B. 24/7)', 'hausmeister-theme' ),
			"stat_{$s}_animate" => __( 'Animieren (1=ja, 0=nein)', 'hausmeister-theme' ),
			"stat_{$s}_label"   => __( 'Beschriftung', 'hausmeister-theme' ),
		) as $key => $label ) {
			$wp_customize->add_setting( 'hausmeister_' . $key, array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'hausmeister_' . $key, array(
				/* translators: %d: stat number */
				'label'   => sprintf( __( 'Stat %d — %s', 'hausmeister-theme' ), $s, $label ),
				'section' => 'hausmeister_home_stats',
				'type'    => 'text',
			) );
		}
	}

	// --- Homepage Services ---
	$wp_customize->add_section( 'hausmeister_home_services', array(
		'title' => __( 'Startseite — Leistungen', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'services_section_label', 'services_heading', 'services_subheading', 'service_link_text' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $key,
			'section' => 'hausmeister_home_services',
			'type'    => $key === 'services_subheading' ? 'textarea' : 'text',
		) );
	}

	for ( $i = 1; $i <= 5; $i++ ) {
		$wp_customize->add_setting( 'hausmeister_service_' . $i . '_icon', array(
			'default'           => $defaults[ 'service_' . $i . '_icon' ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_service_' . $i . '_icon', array(
			/* translators: %d: service number */
			'label'   => sprintf( __( 'Leistung %d — Icon (Font Awesome Klasse)', 'hausmeister-theme' ), $i ),
			'section' => 'hausmeister_home_services',
			'type'    => 'text',
		) );

		$wp_customize->add_setting( 'hausmeister_service_' . $i . '_title', array(
			'default'           => $defaults[ 'service_' . $i . '_title' ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_service_' . $i . '_title', array(
			/* translators: %d: service number */
			'label'   => sprintf( __( 'Leistung %d — Titel', 'hausmeister-theme' ), $i ),
			'section' => 'hausmeister_home_services',
			'type'    => 'text',
		) );

		$wp_customize->add_setting( 'hausmeister_service_' . $i . '_description', array(
			'default'           => $defaults[ 'service_' . $i . '_description' ],
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( 'hausmeister_service_' . $i . '_description', array(
			/* translators: %d: service number */
			'label'   => sprintf( __( 'Leistung %d — Beschreibung', 'hausmeister-theme' ), $i ),
			'section' => 'hausmeister_home_services',
			'type'    => 'textarea',
		) );

		$wp_customize->add_setting( 'hausmeister_service_' . $i . '_url', array(
			'default'           => $defaults[ 'service_' . $i . '_url' ],
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'hausmeister_service_' . $i . '_url', array(
			/* translators: %d: service number */
			'label'   => sprintf( __( 'Leistung %d — Link URL', 'hausmeister-theme' ), $i ),
			'section' => 'hausmeister_home_services',
			'type'    => 'url',
		) );

		$wp_customize->add_setting( 'hausmeister_service_' . $i . '_tags', array(
			'default'           => isset( $defaults[ 'service_' . $i . '_tags' ] ) ? $defaults[ 'service_' . $i . '_tags' ] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_service_' . $i . '_tags', array(
			/* translators: %d: service number */
			'label'       => sprintf( __( 'Leistung %d — Tags (kommagetrennt)', 'hausmeister-theme' ), $i ),
			'section'     => 'hausmeister_home_services',
			'type'        => 'text',
			'description' => __( 'z.B. Rasenmähen, Heckenschnitt, Unkrautbeseitigung', 'hausmeister-theme' ),
		) );
	}

	// --- Homepage Why Us ---
	$wp_customize->add_section( 'hausmeister_home_features', array(
		'title' => __( 'Startseite — Warum wir', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array(
		'why_section_label'   => __( 'Sektions-Label', 'hausmeister-theme' ),
		'features_heading'    => __( 'Überschrift', 'hausmeister-theme' ),
		'why_quote_author'    => __( 'Zitat-Autor', 'hausmeister-theme' ),
	) as $key => $label ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $label,
			'section' => 'hausmeister_home_features',
			'type'    => 'text',
		) );
	}

	$wp_customize->add_setting( 'hausmeister_features_subheading', array(
		'default'           => $defaults['features_subheading'],
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'hausmeister_features_subheading', array(
		'label'   => __( 'Intro-Text', 'hausmeister-theme' ),
		'section' => 'hausmeister_home_features',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'hausmeister_why_image', array(
		'default'           => $defaults['why_image'],
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hausmeister_why_image', array(
		'label'   => __( 'Bild (rechte Spalte)', 'hausmeister-theme' ),
		'section' => 'hausmeister_home_features',
	) ) );

	for ( $i = 1; $i <= 3; $i++ ) {
		foreach ( array(
			'icon'        => __( 'Icon (Font Awesome Klasse)', 'hausmeister-theme' ),
			'title'       => __( 'Titel', 'hausmeister-theme' ),
			'description' => __( 'Beschreibung', 'hausmeister-theme' ),
			'quote'       => __( 'Zitat (für Bild-Karte)', 'hausmeister-theme' ),
		) as $field => $field_label ) {
			$key = 'feature_' . $i . '_' . $field;
			$wp_customize->add_setting( 'hausmeister_' . $key, array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => in_array( $field, array( 'description', 'quote' ), true ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'hausmeister_' . $key, array(
				/* translators: %1$d: pillar number, %2$s: field label */
				'label'   => sprintf( __( 'Säule %1$d — %2$s', 'hausmeister-theme' ), $i, $field_label ),
				'section' => 'hausmeister_home_features',
				'type'    => in_array( $field, array( 'description', 'quote' ), true ) ? 'textarea' : 'text',
			) );
		}
	}

	// --- Homepage Before & After ---
	$wp_customize->add_section( 'hausmeister_home_before_after', array(
		'title' => __( 'Startseite — Vorher & Nachher', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array(
		'ba_section_label' => __( 'Sektions-Label', 'hausmeister-theme' ),
		'ba_heading'       => __( 'Überschrift', 'hausmeister-theme' ),
	) as $key => $label ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $label,
			'section' => 'hausmeister_home_before_after',
			'type'    => 'text',
		) );
	}

	$wp_customize->add_setting( 'hausmeister_ba_subheading', array(
		'default'           => $defaults['ba_subheading'],
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'hausmeister_ba_subheading', array(
		'label'   => __( 'Untertitel', 'hausmeister-theme' ),
		'section' => 'hausmeister_home_before_after',
		'type'    => 'textarea',
	) );

	for ( $i = 1; $i <= 5; $i++ ) {
		$key = 'ba_' . $i . '_category';
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
			'sanitize_callback' => 'sanitize_key',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			/* translators: %d: item number */
			'label'       => sprintf( __( 'Projekt %d — Kategorie (treppenhaus, gruen, fassade, glas, winter)', 'hausmeister-theme' ), $i ),
			'section'     => 'hausmeister_home_before_after',
			'type'        => 'text',
			'description' => __( 'Filter-Schlüssel für diese Karte.', 'hausmeister-theme' ),
		) );

		foreach ( array(
			'title'       => array( 'label' => __( 'Projekt-Titel', 'hausmeister-theme' ), 'type' => 'text' ),
			'description' => array( 'label' => __( 'Beschreibung', 'hausmeister-theme' ), 'type' => 'textarea' ),
			'location'    => array( 'label' => __( 'Ort / Objekt', 'hausmeister-theme' ), 'type' => 'text' ),
		) as $field => $meta ) {
			$key = 'ba_' . $i . '_' . $field;
			$wp_customize->add_setting( 'hausmeister_' . $key, array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => 'textarea' === $meta['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'hausmeister_' . $key, array(
				/* translators: %1$d: item number, %2$s: field label */
				'label'   => sprintf( __( 'Projekt %1$d — %2$s', 'hausmeister-theme' ), $i, $meta['label'] ),
				'section' => 'hausmeister_home_before_after',
				'type'    => $meta['type'],
			) );
		}

		foreach ( array( 'before' => __( 'Vorher-Bild', 'hausmeister-theme' ), 'after' => __( 'Nachher-Bild', 'hausmeister-theme' ) ) as $field => $label ) {
			$key = 'ba_' . $i . '_' . $field;
			$wp_customize->add_setting( 'hausmeister_' . $key, array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hausmeister_' . $key, array(
				/* translators: %1$d: item number, %2$s: before/after label */
				'label'   => sprintf( __( 'Projekt %1$d — %2$s', 'hausmeister-theme' ), $i, $label ),
				'section' => 'hausmeister_home_before_after',
			) ) );
		}
	}

	// --- Homepage CTA ---
	$wp_customize->add_section( 'hausmeister_home_cta', array(
		'title' => __( 'Startseite — Call-to-Action', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'cta_heading', 'cta_text', 'cta_btn_text', 'cta_btn_url' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => $key === 'cta_btn_url' ? 'esc_url_raw' : ( $key === 'cta_text' ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $key,
			'section' => 'hausmeister_home_cta',
			'type'    => $key === 'cta_text' ? 'textarea' : 'text',
		) );
	}

	// --- Leistungen page ---
	$wp_customize->add_section( 'hausmeister_page_services', array(
		'title' => __( 'Seite — Leistungen', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'services_page_title', 'services_page_subtitle' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $key,
			'section' => 'hausmeister_page_services',
			'type'    => 'text',
		) );
	}

	// --- Über uns page ---
	$wp_customize->add_section( 'hausmeister_page_about', array(
		'title' => __( 'Seite — Über uns', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'about_page_title', 'about_page_subtitle' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $key,
			'section' => 'hausmeister_page_about',
			'type'    => 'text',
		) );
	}

	$wp_customize->add_setting( 'hausmeister_about_intro_text', array(
		'default'           => $defaults['about_intro_text'],
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'hausmeister_about_intro_text', array(
		'label'   => __( 'Intro-Text', 'hausmeister-theme' ),
		'section' => 'hausmeister_page_about',
		'type'    => 'textarea',
	) );

	for ( $i = 1; $i <= 3; $i++ ) {
		foreach ( array( 'icon', 'title', 'description' ) as $field ) {
			$key = 'about_value_' . $i . '_' . $field;
			$wp_customize->add_setting( 'hausmeister_' . $key, array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $field === 'description' ? 'sanitize_textarea_field' : 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'hausmeister_' . $key, array(
				'label'   => $key,
				'section' => 'hausmeister_page_about',
				'type'    => $field === 'description' ? 'textarea' : 'text',
			) );
		}
	}

	// --- Kontakt page ---
	$wp_customize->add_section( 'hausmeister_page_contact', array(
		'title' => __( 'Seite — Kontakt', 'hausmeister-theme' ),
		'panel' => 'hausmeister_panel',
	) );

	foreach ( array( 'contact_page_title', 'contact_page_subtitle', 'contact_info_text', 'contact_form_submit_text' ) as $key ) {
		$wp_customize->add_setting( 'hausmeister_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => in_array( $key, array( 'contact_page_subtitle', 'contact_info_text' ), true ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'hausmeister_' . $key, array(
			'label'   => $key,
			'section' => 'hausmeister_page_contact',
			'type'    => in_array( $key, array( 'contact_page_subtitle', 'contact_info_text' ), true ) ? 'textarea' : 'text',
		) );
	}
}
add_action( 'customize_register', 'hausmeister_customize_register' );
