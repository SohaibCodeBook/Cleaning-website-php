<?php
/**
 * Single service page helpers, defaults, and Customizer registration.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Service slug => index map.
 *
 * @return array<string, int>
 */
function hausmeister_get_service_slug_map() {
	return array(
		'hausmeistertaetigkeiten'  => 1,
		'reinigung-instandhaltung' => 2,
		'gruenanlagenpflege'       => 3,
		'entruempelungen'          => 4,
		'winterdienst'             => 5,
	);
}

/**
 * Find a service page by slug (top-level or legacy nested path).
 *
 * @param string $slug Service slug.
 * @return WP_Post|null
 */
function hausmeister_get_service_page_by_slug( $slug ) {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page && 'publish' === $page->post_status ) {
		return $page;
	}

	$page = get_page_by_path( 'leistungen/' . $slug, OBJECT, 'page' );
	if ( $page && 'publish' === $page->post_status ) {
		return $page;
	}

	return null;
}

/**
 * Get service index from a page object or slug.
 *
 * @param WP_Post|string|null $page Post object or slug.
 * @return int 0 if not a service page.
 */
function hausmeister_get_service_index_from_page( $page = null ) {
	if ( is_string( $page ) ) {
		$map = hausmeister_get_service_slug_map();
		return isset( $map[ $page ] ) ? (int) $map[ $page ] : 0;
	}

	if ( ! $page instanceof WP_Post ) {
		$page = get_queried_object();
	}

	if ( ! $page instanceof WP_Post || 'page' !== $page->post_type ) {
		return 0;
	}

	$map  = hausmeister_get_service_slug_map();
	$slug = $page->post_name;

	if ( isset( $map[ $slug ] ) ) {
		return (int) $map[ $slug ];
	}

	$path = trim( str_replace( home_url( '/' ), '', get_permalink( $page ) ), '/' );
	if ( preg_match( '#leistungen/([^/]+)/?$#', $path, $matches ) && isset( $map[ $matches[1] ] ) ) {
		return (int) $map[ $matches[1] ];
	}

	if ( 'page-service.php' === get_page_template_slug( $page ) ) {
		foreach ( $map as $service_slug => $index ) {
			if ( false !== strpos( $path, $service_slug ) ) {
				return (int) $index;
			}
		}
	}

	return 0;
}

/**
 * Get a service page setting.
 *
 * @param int    $index   Service index 1–5.
 * @param string $key     Field key without prefix.
 * @param string $default Optional fallback.
 * @return string
 */
function page_service( $index, $key, $default = '' ) {
	return page_home( 'service_' . (int) $index . '_sp_' . $key, $default );
}

/**
 * Get two related service indexes.
 *
 * @param int $current Current service index.
 * @return int[]
 */
function hausmeister_get_related_service_indexes( $current ) {
	$related = array();
	for ( $offset = 1; $offset <= 2; $offset++ ) {
		$i = ( ( (int) $current - 1 + $offset ) % 5 ) + 1;
		if ( $i !== (int) $current ) {
			$related[] = $i;
		}
	}
	return $related;
}

/**
 * Render breadcrumbs for a service page.
 *
 * @param int $index Service index.
 */
function hausmeister_service_breadcrumbs( $index ) {
	$title = page_home( "service_{$index}_title" );
	?>
	<nav class="sp-breadcrumbs" aria-label="<?php esc_attr_e( 'Brotkrumen-Navigation', 'hausmeister-theme' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Startseite', 'hausmeister-theme' ); ?></a>
		<span aria-hidden="true">/</span>
		<span class="sp-breadcrumbs__current"><?php echo esc_html( $title ); ?></span>
	</nav>
	<?php
}

/**
 * Base content blueprint per service.
 *
 * @return array<int, array<string, mixed>>
 */
function hausmeister_get_service_content_blueprints() {
	return array(
		1 => array(
			'slug'       => 'hausmeistertaetigkeiten',
			'badges'     => array( 'Geprüfte Qualität', 'Fester Ansprechpartner', 'Schnelle Reaktion' ),
			'hero'       => 'Professionelle Hausmeistertätigkeiten für Wohn- und Gewerbeimmobilien — zuverlässige Objektbetreuung, Kleinreparaturen und klare Kommunikation aus einer Hand.',
			'highlights' => "Kontrollgänge & Protokolle\nKleinreparaturen vor Ort\nMüll- & Containerbetreuung",
			'features_heading' => 'Was unsere Hausmeisterleistung umfasst',
			'features'   => array(
				array( 'fa-solid fa-clipboard-check', 'Objektkontrollen', 'Regelmäßige Kontrollgänge mit dokumentierten Protokollen für Eigentümer und Verwaltungen.' ),
				array( 'fa-solid fa-screwdriver-wrench', 'Kleinreparaturen', 'Schnelle Hilfe bei kleineren Schäden — von der Tür bis zur Beleuchtung im Treppenhaus.' ),
				array( 'fa-solid fa-trash-can', 'Müll & Entsorgung', 'Betreuung von Müllplätzen, Containern und gemeinschaftlichen Entsorgungsbereichen.' ),
				array( 'fa-solid fa-user-shield', 'Ansprechpartner vor Ort', 'Verlässlicher Kontakt für Mieter, Eigentümer und Hausverwaltungen.' ),
				array( 'fa-solid fa-bell-concierge', 'Schlüssel & Zugänge', 'Organisation von Zugängen, Übergaben und koordinierten Terminen.' ),
				array( 'fa-solid fa-clock', 'Flexible Einsatzzeiten', 'Einsätze nach Objektbedarf — auch außerhalb der Kernzeiten.' ),
			),
			'intro'   => 'Als Hausmeisterservice übernehmen wir die laufende Betreuung Ihrer Immobilie mit klaren Abläufen und transparenten Leistungsverzeichnissen. So bleiben Ihre Objekte sicher, sauber und funktionsfähig — und Sie haben weniger Koordinationsaufwand.',
			'steps'   => array(
				array( 'Objektbegehung', 'Wir erfassen den Zustand, besprechen Anforderungen und definieren den Leistungsumfang.' ),
				array( 'Betreuungsplan', 'Sie erhalten einen strukturierten Plan mit Einsatzintervallen und festen Ansprechpartnern.' ),
				array( 'Laufende Betreuung', 'Unser Team führt Kontrollen, Reparaturen und Meldungen termingerecht aus.' ),
				array( 'Qualitätsfeedback', 'Regelmäßige Rückmeldungen und Anpassungen sichern dauerhafte Zufriedenheit.' ),
			),
			'sectors' => 'Wohnanlagen, Mehrfamilienhäuser, Gewerbeobjekte, Verwaltungsobjekte, Pflegeeinrichtungen',
			'faqs'    => array(
				array( 'Welche Aufgaben übernimmt ein Hausmeister?', 'Typische Leistungen sind Kontrollgänge, Kleinreparaturen, Müllbetreuung, Meldung von Schäden und die Koordination mit Handwerkern.' ),
				array( 'Können Einsatzzeiten individuell vereinbart werden?', 'Ja. Wir passen Intervalle und Reaktionszeiten an Ihr Objekt und Ihre Hausordnung an.' ),
				array( 'Sind Kleinreparaturen im Service enthalten?', 'Kleinreparaturen können fest vereinbart oder nach Aufwand abgerechnet werden — transparent im Angebot.' ),
				array( 'Wie schnell reagieren Sie bei Störungen?', 'Je nach Vereinbarung setzen wir priorisierte Reaktionszeiten für dringende Meldungen um.' ),
			),
		),
		2 => array(
			'slug'       => 'reinigung-instandhaltung',
			'badges'     => array( 'Hygienisch sauber', 'Modernes Equipment', 'Termingerecht' ),
			'hero'       => 'Gründliche Reinigung und Instandhaltung für Treppenhäuser, Fenster, Dachrinnen, PV-Anlagen, Fassaden und Parkplätze — professionell und zuverlässig.',
			'highlights' => "Treppenhausreinigung\nGlas- & Fassadenreinigung\nDachrinnen & Außenflächen",
			'features_heading' => 'Reinigung & Instandhaltung im Detail',
			'features'   => array(
				array( 'fa-solid fa-stairs', 'Treppenhausreinigung', 'Regelmäßige Reinigung von Fluren, Geländern und Eingangsbereichen.' ),
				array( 'fa-solid fa-window-maximize', 'Glasreinigung', 'Streifenfreie Fenster und Glasflächen für mehr Licht und Transparenz.' ),
				array( 'fa-solid fa-building', 'Fassadenreinigung', 'Schonende Reinigung verschmutzter Fassaden und Außenwände.' ),
				array( 'fa-solid fa-water', 'Dachrinnen & Entwässerung', 'Reinigung und Funktionsprüfung von Dachrinnen und Abläufen.' ),
				array( 'fa-solid fa-solar-panel', 'PV-Anlagen', 'Fachgerechte Reinigung zur Erhaltung der Anlagenleistung.' ),
				array( 'fa-solid fa-square-parking', 'Parkplätze & Zufahrten', 'Saubere Außenflächen für einen gepflegten Gesamteindruck.' ),
			),
			'intro'   => 'Mit geschultem Personal und abgestimmten Reinigungsplänen sorgen wir für hygienische Sauberkeit und Werterhalt Ihrer Immobilie. Von der regelmäßigen Unterhaltsreinigung bis zu Sonderreinigungen passen wir uns Ihren Anforderungen an.',
			'steps'   => array(
				array( 'Begehung & Analyse', 'Wir erfassen Flächen, Materialien und Reinigungsintervalle vor Ort.' ),
				array( 'Reinigungskonzept', 'Transparentes Leistungsverzeichnis mit klaren Preisen und Rhythmen.' ),
				array( 'Professionelle Ausführung', 'Einsatz mit geeigneten Mitteln und Geräten — termingerecht und gründlich.' ),
				array( 'Qualitätskontrolle', 'Regelmäßige Prüfungen und offene Kommunikation mit Ihrem Ansprechpartner.' ),
			),
			'sectors' => 'Bürogebäude, Wohnanlagen, Gewerbeimmobilien, Praxen, Bildungseinrichtungen',
			'faqs'    => array(
				array( 'Wie oft sollte ein Treppenhaus gereinigt werden?', 'Je nach Nutzung meist wöchentlich bis monatlich — wir empfehlen einen passenden Rhythmus nach Begehung.' ),
				array( 'Reinigen Sie auch Fassaden und PV-Anlagen?', 'Ja, beides gehört zu unserem Leistungsspektrum — mit geeigneter Technik und Sicherheitskonzept.' ),
				array( 'Verwenden Sie umweltfreundliche Mittel?', 'Auf Wunsch setzen wir zertifizierte, umweltbewusste Reinigungsprodukte ein.' ),
				array( 'Können Reinigungen außerhalb der Geschäftszeiten erfolgen?', 'Ja, flexible Einsatzzeiten sind möglich, damit der Betrieb nicht gestört wird.' ),
			),
		),
		3 => array(
			'slug'       => 'gruenanlagenpflege',
			'badges'     => array( 'Ganzjährig', 'Fachgerecht', 'Gepflegtes Erscheinungsbild' ),
			'hero'       => 'Professionelle Grünanlagenpflege für Außenflächen, Rasen, Hecken und Beete — für einen einladenden ersten Eindruck Ihrer Immobilie.',
			'highlights' => "Rasen- & Beetpflege\nHecken- & Strauchschnitt\nSaisonale Pflegepläne",
			'features_heading' => 'Leistungen in der Grünanlagenpflege',
			'features'   => array(
				array( 'fa-solid fa-seedling', 'Rasenpflege', 'Mähen, Düngen und Pflege für dichte, gesunde Rasenflächen.' ),
				array( 'fa-solid fa-scissors', 'Heckenschnitt', 'Form- und Pflegeschnitt für Hecken und Sträucher.' ),
				array( 'fa-solid fa-spa', 'Beetpflege', 'Unkrautentfernung, Bodenpflege und saisonale Bepflanzung.' ),
				array( 'fa-solid fa-tree', 'Baumpflege', 'Kontrolle und grundlegende Pflege von Bäumen in Außenanlagen.' ),
				array( 'fa-solid fa-recycle', 'Laubentsorgung', 'Entfernung und fachgerechte Entsorgung von Laub und Schnittgut.' ),
				array( 'fa-solid fa-calendar-check', 'Saisonplanung', 'Pflegepläne für Frühjahr, Sommer, Herbst und Winter.' ),
			),
			'intro'   => 'Gepflegte Außenanlagen steigern den Wert und die Attraktivität Ihrer Liegenschaft. Wir kümmern uns zuverlässig um Grünflächen — planbar, saisonal abgestimmt und mit Blick auf Nachhaltigkeit.',
			'steps'   => array(
				array( 'Bestandsaufnahme', 'Wir bewerten Flächen, Pflanzen und Pflegebedarf vor Ort.' ),
				array( 'Pflegeplan', 'Individueller Jahresplan mit klaren Einsatzterminen.' ),
				array( 'Regelmäßige Pflege', 'Fachgerechte Durchführung aller vereinbarten Arbeiten.' ),
				array( 'Saisonanpassung', 'Flexible Anpassung bei Witterung und Vegetationsphase.' ),
			),
			'sectors' => 'Wohnanlagen, Gewerbeobjekte, Pflegeheime, Verwaltungsgebäude, Wohnungsbaugesellschaften',
			'faqs'    => array(
				array( 'Wie oft muss ein Rasen gemäht werden?', 'In der Wachstumsphase typischerweise wöchentlich bis 14-tägig — abhängig von Witterung und Nutzung.' ),
				array( 'Übernehmen Sie auch Winterpflege von Grünflächen?', 'Ja, z. B. Laubbeseitigung und Vorbereitung der Anlagen auf die kalte Jahreszeit.' ),
				array( 'Entsorgen Sie Schnittgut und Laub?', 'Ja, die fachgerechte Entsorgung kann mit vereinbart werden.' ),
				array( 'Erstellen Sie Pflegepläne für das ganze Jahr?', 'Ja, wir planen alle Leistungen saisonal und transparent.' ),
			),
		),
		4 => array(
			'slug'       => 'entruempelungen',
			'badges'     => array( 'Diskret', 'Schnell', 'Inkl. Entsorgung' ),
			'hero'       => 'Schnelle und diskrete Entrümpelungen von Wohnungen, Kellern, Dachböden und Gewerbeflächen — inklusive fachgerechter Entsorgung.',
			'highlights' => "Wohnungsräumung\nKeller & Dachboden\nGewerbe & Objekte",
			'features_heading' => 'Unser Entrümpelungsservice',
			'features'   => array(
				array( 'fa-solid fa-house-chimney', 'Wohnungsentrümpelung', 'Komplette Räumung von Wohnungen und Häusern.' ),
				array( 'fa-solid fa-warehouse', 'Keller & Dachboden', 'Entrümpelung enger und schwer zugänglicher Bereiche.' ),
				array( 'fa-solid fa-truck', 'Transport & Entsorgung', 'Abtransport und fachgerechte Entsorgung aller Materialien.' ),
				array( 'fa-solid fa-recycle', 'Sortierung & Recycling', 'Trennung von Wertstoffen und Restmüll nach Vorgaben.' ),
				array( 'fa-solid fa-user-secret', 'Diskrete Abwicklung', 'Sensible Abwicklung bei Nachlass- und Sonderfällen.' ),
				array( 'fa-solid fa-bolt', 'Kurzfristige Termine', 'Schnelle Einsatzplanung bei engen Fristen.' ),
			),
			'intro'   => 'Ob Wohnungsauflösung, Kellerentrümpelung oder Gewerbefläche — wir räumen gründlich, sortieren Materialien und hinterlassen die Flächen besenrein. Transparente Kosten und feste Ansprechpartner inklusive.',
			'steps'   => array(
				array( 'Besichtigung', 'Wir schätzen Umfang, Zugang und Entsorgungsbedarf vor Ort.' ),
				array( 'Festpreisangebot', 'Klares Angebot ohne versteckte Kosten.' ),
				array( 'Räumung & Sortierung', 'Strukturierte Entrümpelung mit geeignetem Personal und Fahrzeugen.' ),
				array( 'Übergabe besenrein', 'Fachgerechte Entsorgung und saubere Übergabe der Fläche.' ),
			),
			'sectors' => 'Privatwohnungen, Eigentümergemeinschaften, Verwaltungen, Gewerbe, Pflege- & Senioreneinrichtungen',
			'faqs'    => array(
				array( 'Wie schnell kann eine Entrümpelung erfolgen?', 'Je nach Umfang oft innerhalb weniger Tage — nach Vor-Ort-Termin mit Terminplan.' ),
				array( 'Ist die Entsorgung im Preis enthalten?', 'Ja, Transport und Entsorgung werden im Angebot ausgewiesen.' ),
				array( 'Entrümpeln Sie auch Messie-Wohnungen?', 'Ja, diskret und strukturiert — sprechen Sie uns vertraulich an.' ),
				array( 'Erhalten wir die Fläche besenrein zurück?', 'Ja, besenreine Übergabe ist unser Standard.' ),
			),
		),
		5 => array(
			'slug'       => 'winterdienst',
			'badges'     => array( '24/7 Bereitschaft', 'Rechtssicher', 'Dokumentiert' ),
			'hero'       => 'Zuverlässiger Winterdienst für Geh- und Fahrwege — Räum- und Streuarbeiten, damit Ihre Verkehrssicherungspflicht erfüllt bleibt.',
			'highlights' => "Schneeräumung\nStreudienst\nEinsatzprotokolle",
			'features_heading' => 'Leistungen im Winterdienst',
			'features'   => array(
				array( 'fa-solid fa-snowplow', 'Schneeräumung', 'Räumung von Gehwegen, Zufahrten und Parkflächen.' ),
				array( 'fa-solid fa-road', 'Streudienst', 'Streuung mit Salz, Splitt oder alternativen Mitteln nach Bedarf.' ),
				array( 'fa-solid fa-temperature-low', 'Glättebeseitigung', 'Rechtzeitige Maßnahmen bei Glatteis und Schnee.' ),
				array( 'fa-solid fa-file-lines', 'Einsatzprotokolle', 'Dokumentation für Ihre Verkehrssicherung und Nachweise.' ),
				array( 'fa-solid fa-clock', 'Bereitschaftsdienst', 'Früheinsätze und Witterungsbeobachtung inklusive.' ),
				array( 'fa-solid fa-map-location-dot', 'Objektbezogene Pläne', 'Individuelle Räum- und Streupläne pro Liegenschaft.' ),
			),
			'intro'   => 'Im Winter trägt der Eigentümer die Verkehrssicherungspflicht. Wir übernehmen den Winterdienst mit klaren Einsatzplänen, zuverlässiger Bereitschaft und nachvollziehbarer Dokumentation — für Wohn- und Gewerbeobjekte.',
			'steps'   => array(
				array( 'Objektbegehung', 'Erfassung aller relevanten Wege, Flächen und Gefahrenstellen.' ),
				array( 'Winterdienstplan', 'Festlegung von Räum- und Streupflichten, Mitteln und Reaktionszeiten.' ),
				array( 'Witterungseinsätze', 'Proaktive Einsätze bei Schnee, Glatteis und Glätte.' ),
				array( 'Protokoll & Nachweis', 'Dokumentation der durchgeführten Maßnahmen für Ihre Sicherheit.' ),
			),
			'sectors' => 'Wohnanlagen, Gewerbeobjekte, Arztpraxen, Bildungseinrichtungen, Parkplätze',
			'faqs'    => array(
				array( 'Wann beginnt der Winterdienst?', 'In der Regel ab vereinbartem Stichtag — oft ab November bis einschließlich März.' ),
				array( 'Sind Einsatzprotokolle enthalten?', 'Ja, wir dokumentieren Einsätze für Ihre Nachweise.' ),
				array( 'Welche Streumittel verwenden Sie?', 'Je nach Objekt und Vorgabe Salz, Splitt oder umweltfreundliche Alternativen.' ),
				array( 'Gibt es Bereitschaft außerhalb der Geschäftszeiten?', 'Ja, Witterungsbeobachtung und Früheinsätze sind Teil unseres Services.' ),
			),
		),
	);
}

/**
 * Build Customizer defaults for all service pages.
 *
 * @return array<string, string>
 */
function hausmeister_get_service_page_defaults() {
	$defaults   = array();
	$blueprints = hausmeister_get_service_content_blueprints();

	foreach ( $blueprints as $index => $data ) {
		$prefix = 'service_' . $index . '_sp_';

		$defaults[ $prefix . 'badge_1' ]           = $data['badges'][0];
		$defaults[ $prefix . 'badge_2' ]           = $data['badges'][1];
		$defaults[ $prefix . 'badge_3' ]           = $data['badges'][2];
		$defaults[ $prefix . 'hero_text' ]         = $data['hero'];
		$defaults[ $prefix . 'highlights' ]        = $data['highlights'];
		$defaults[ $prefix . 'hero_btn_text' ]     = 'Kostenlos beraten lassen';
		$defaults[ $prefix . 'hero_btn_url' ]      = '/kontakt/';
		$defaults[ $prefix . 'features_label' ]     = 'Leistungsmerkmale';
		$defaults[ $prefix . 'features_heading' ]   = $data['features_heading'];
		$defaults[ $prefix . 'intro_text' ]         = $data['intro'];
		$defaults[ $prefix . 'process_label' ]       = 'Unser Prozess';
		$defaults[ $prefix . 'process_heading' ]     = 'So arbeiten wir mit Ihnen';
		$defaults[ $prefix . 'sectors_label' ]      = 'Einsatzbereiche';
		$defaults[ $prefix . 'sectors_heading' ]   = 'Für diese Objekte im Einsatz';
		$defaults[ $prefix . 'sectors_list' ]       = $data['sectors'];
		$defaults[ $prefix . 'faq_label' ]          = 'FAQ';
		$defaults[ $prefix . 'faq_heading' ]        = 'Häufige Fragen';
		$defaults[ $prefix . 'related_heading' ]    = 'Weitere Leistungen';
		$defaults[ $prefix . 'cta_heading' ]         = 'Interesse an dieser Leistung?';
		$defaults[ $prefix . 'cta_text' ]           = 'Lassen Sie sich unverbindlich beraten — wir erstellen ein individuelles Angebot für Ihr Objekt.';

		foreach ( $data['features'] as $f_index => $feature ) {
			$n = $f_index + 1;
			$defaults[ $prefix . "feature_{$n}_icon" ]  = $feature[0];
			$defaults[ $prefix . "feature_{$n}_title" ] = $feature[1];
			$defaults[ $prefix . "feature_{$n}_text" ]  = $feature[2];
		}

		foreach ( $data['steps'] as $s_index => $step ) {
			$n = $s_index + 1;
			$defaults[ $prefix . "step_{$n}_title" ] = $step[0];
			$defaults[ $prefix . "step_{$n}_text" ]  = $step[1];
		}

		foreach ( $data['faqs'] as $q_index => $faq ) {
			$n = $q_index + 1;
			$defaults[ $prefix . "faq_{$n}_question" ] = $faq[0];
			$defaults[ $prefix . "faq_{$n}_answer" ]   = $faq[1];
		}
	}

	return $defaults;
}

/**
 * Register service page Customizer sections.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @param array                $defaults     Theme defaults.
 */
function hausmeister_register_service_page_customizer( $wp_customize, $defaults ) {
	for ( $i = 1; $i <= 5; $i++ ) {
		$title = isset( $defaults[ "service_{$i}_title" ] ) ? $defaults[ "service_{$i}_title" ] : sprintf( __( 'Leistung %d', 'hausmeister-theme' ), $i );

		$wp_customize->add_section(
			'hausmeister_service_page_' . $i,
			array(
				'title' => sprintf( __( 'Leistungsseite — %s', 'hausmeister-theme' ), $title ),
				'panel' => 'hausmeister_panel',
			)
		);

		$section = 'hausmeister_service_page_' . $i;
		$prefix  = 'service_' . $i . '_sp_';

		$simple_fields = array(
			'badge_1'          => __( 'Badge 1', 'hausmeister-theme' ),
			'badge_2'          => __( 'Badge 2', 'hausmeister-theme' ),
			'badge_3'          => __( 'Badge 3', 'hausmeister-theme' ),
			'hero_btn_text'    => __( 'Hero Button Text', 'hausmeister-theme' ),
			'features_label'   => __( 'Merkmale — Label', 'hausmeister-theme' ),
			'features_heading' => __( 'Merkmale — Überschrift', 'hausmeister-theme' ),
			'process_label'    => __( 'Prozess — Label', 'hausmeister-theme' ),
			'process_heading'  => __( 'Prozess — Überschrift', 'hausmeister-theme' ),
			'sectors_label'    => __( 'Einsatzbereiche — Label', 'hausmeister-theme' ),
			'sectors_heading'  => __( 'Einsatzbereiche — Überschrift', 'hausmeister-theme' ),
			'faq_label'        => __( 'FAQ — Label', 'hausmeister-theme' ),
			'faq_heading'      => __( 'FAQ — Überschrift', 'hausmeister-theme' ),
			'related_heading'  => __( 'Verwandte Leistungen — Überschrift', 'hausmeister-theme' ),
			'cta_heading'      => __( 'CTA — Überschrift', 'hausmeister-theme' ),
		);

		foreach ( $simple_fields as $key => $label ) {
			$setting = $prefix . $key;
			$wp_customize->add_setting(
				'hausmeister_' . $setting,
				array(
					'default'           => isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				'hausmeister_' . $setting,
				array(
					'label'   => $label,
					'section' => $section,
					'type'    => 'text',
				)
			);
		}

		$textarea_fields = array(
			'hero_text'    => __( 'Hero Text', 'hausmeister-theme' ),
			'highlights'   => __( 'Hero Stichpunkte (eine Zeile pro Punkt)', 'hausmeister-theme' ),
			'intro_text'   => __( 'Intro Absatz', 'hausmeister-theme' ),
			'sectors_list' => __( 'Einsatzbereiche (kommagetrennt)', 'hausmeister-theme' ),
			'cta_text'     => __( 'CTA — Text', 'hausmeister-theme' ),
		);

		foreach ( $textarea_fields as $key => $label ) {
			$setting = $prefix . $key;
			$wp_customize->add_setting(
				'hausmeister_' . $setting,
				array(
					'default'           => isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '',
					'sanitize_callback' => 'sanitize_textarea_field',
				)
			);
			$wp_customize->add_control(
				'hausmeister_' . $setting,
				array(
					'label'   => $label,
					'section' => $section,
					'type'    => 'textarea',
				)
			);
		}

		$url_setting = $prefix . 'hero_btn_url';
		$wp_customize->add_setting(
			'hausmeister_' . $url_setting,
			array(
				'default'           => isset( $defaults[ $url_setting ] ) ? $defaults[ $url_setting ] : '/kontakt/',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'hausmeister_' . $url_setting,
			array(
				'label'   => __( 'Hero Button URL', 'hausmeister-theme' ),
				'section' => $section,
				'type'    => 'text',
			)
		);

		for ( $f = 1; $f <= 6; $f++ ) {
			foreach ( array(
				'icon'  => array( 'label' => __( 'Icon (Font Awesome)', 'hausmeister-theme' ), 'type' => 'text' ),
				'title' => array( 'label' => __( 'Titel', 'hausmeister-theme' ), 'type' => 'text' ),
				'text'  => array( 'label' => __( 'Text', 'hausmeister-theme' ), 'type' => 'textarea' ),
			) as $field => $meta ) {
				$setting = $prefix . "feature_{$f}_{$field}";
				$wp_customize->add_setting(
					'hausmeister_' . $setting,
					array(
						'default'           => isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '',
						'sanitize_callback' => 'textarea' === $meta['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
					)
				);
				$wp_customize->add_control(
					'hausmeister_' . $setting,
					array(
						'label'   => sprintf( __( 'Merkmal %1$d — %2$s', 'hausmeister-theme' ), $f, $meta['label'] ),
						'section' => $section,
						'type'    => $meta['type'],
					)
				);
			}
		}

		for ( $s = 1; $s <= 4; $s++ ) {
			foreach ( array(
				'title' => array( 'label' => __( 'Titel', 'hausmeister-theme' ), 'type' => 'text' ),
				'text'  => array( 'label' => __( 'Text', 'hausmeister-theme' ), 'type' => 'textarea' ),
			) as $field => $meta ) {
				$setting = $prefix . "step_{$s}_{$field}";
				$wp_customize->add_setting(
					'hausmeister_' . $setting,
					array(
						'default'           => isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '',
						'sanitize_callback' => 'textarea' === $meta['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
					)
				);
				$wp_customize->add_control(
					'hausmeister_' . $setting,
					array(
						'label'   => sprintf( __( 'Schritt %1$d — %2$s', 'hausmeister-theme' ), $s, $meta['label'] ),
						'section' => $section,
						'type'    => $meta['type'],
					)
				);
			}
		}

		for ( $q = 1; $q <= 4; $q++ ) {
			foreach ( array(
				'question' => array( 'label' => __( 'Frage', 'hausmeister-theme' ), 'type' => 'text' ),
				'answer'   => array( 'label' => __( 'Antwort', 'hausmeister-theme' ), 'type' => 'textarea' ),
			) as $field => $meta ) {
				$setting = $prefix . "faq_{$q}_{$field}";
				$wp_customize->add_setting(
					'hausmeister_' . $setting,
					array(
						'default'           => isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '',
						'sanitize_callback' => 'textarea' === $meta['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
					)
				);
				$wp_customize->add_control(
					'hausmeister_' . $setting,
					array(
						'label'   => sprintf( __( 'FAQ %1$d — %2$s', 'hausmeister-theme' ), $q, $meta['label'] ),
						'section' => $section,
						'type'    => $meta['type'],
					)
				);
			}
		}
	}
}
