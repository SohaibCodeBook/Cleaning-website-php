<?php
/**
 * Default Cookie-Richtlinie content (editable after page creation in WP admin).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default Cookie Policy HTML for the Cookie-Richtlinie page.
 *
 * @return string
 */
function hausmeister_get_default_cookie_policy_html() {
	$company = esc_html( site_data( 'company_name' ) );
	$email   = esc_html( site_data( 'contact_email' ) );
	$phone   = esc_html( site_data( 'phone' ) );
	$tel     = esc_attr( hausmeister_tel_link( site_data( 'phone' ) ) );

	ob_start();
	?>
	<section class="legal-page__section" aria-labelledby="cookie-intro">
		<h2 id="cookie-intro">1. Einleitung</h2>
		<p>Diese Cookie-Richtlinie erläutert, wie die Website von <strong><?php echo $company; ?></strong> Cookies und ähnliche Technologien verwendet.</p>
		<p>Verantwortlich ist:</p>
		<p>
			<strong><?php echo $company; ?></strong><br>
			Inhaber: Sascha Becker<br>
			Am Rang 9<br>
			95615 Marktredwitz<br>
			Deutschland
		</p>
		<p>Weitere Informationen zum Datenschutz finden Sie in unserer <a href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>">Datenschutzerklärung</a>.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-what">
		<h2 id="cookie-what">2. Was sind Cookies?</h2>
		<p>Cookies sind kleine Textdateien, die von einer Website auf Ihrem Endgerät (Computer, Tablet oder Smartphone) gespeichert werden. Sie können Informationen speichern und beim erneuten Besuch wiedererkennen.</p>
		<p>Cookies können technisch erforderlich sein oder — sofern eingesetzt — der Statistik, Funktionalität oder dem Marketing dienen.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-scripts">
		<h2 id="cookie-scripts">3. Was sind Skripte?</h2>
		<p>Skripte sind Programmcode, der auf der Website ausgeführt wird, um Funktionen bereitzustellen (z.&nbsp;B. Navigation, Formulare oder Animationen). Manche Skripte können auch Cookies setzen oder technische Daten verarbeiten.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-beacon">
		<h2 id="cookie-beacon">4. Was ist ein Web-Beacon?</h2>
		<p>Ein Web-Beacon (auch Zählpixel genannt) ist eine kleine, meist unsichtbare Grafik oder ein Skript, mit dem bestimmte Nutzeraktionen gemessen werden können.</p>
		<p>Auf dieser Website werden derzeit keine Web-Beacons zu Tracking- oder Werbezwecken eingesetzt.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-used">
		<h2 id="cookie-used">5. Welche Cookies verwenden wir?</h2>
		<p>Wir unterscheiden zwischen technisch notwendigen Cookies und optionalen Cookies.</p>

		<h3>5.1 Technisch notwendige Cookies</h3>
		<p>Diese Cookies sind für den Betrieb der Website bzw. für gesetzlich erforderliche Funktionen (z.&nbsp;B. Speicherung Ihrer Einwilligungsentscheidung) erforderlich. Sie werden ohne gesonderte Einwilligung gesetzt, soweit dies rechtlich zulässig ist.</p>
		<ul>
			<li>WordPress-Sicherheits- und Sitzungs-Cookies (insbesondere bei Anmeldung im Verwaltungsbereich)</li>
			<li>Cookies eines Consent-/Cookie-Banners zur Speicherung Ihrer Auswahl (sofern ein solches Tool aktiv ist)</li>
			<li>ggf. technisch notwendige Cookies des Hosting-Anbieters</li>
		</ul>

		<h3>5.2 Optionale Cookies (Statistik / Marketing / Externe Medien)</h3>
		<p>Derzeit setzen wir keine Statistik-, Marketing- oder Werbe-Cookies ein. Es wird auch kein Google Analytics oder vergleichbares Tracking verwendet.</p>
		<p>Schriftarten, Bootstrap und Icons werden lokal auf unserem Server bereitgestellt. Dadurch entstehen beim Seitenaufruf keine Verbindungen zu Google Fonts, jsDelivr oder Cloudflare für diese Dateien.</p>
		<p>Externe Links (z.&nbsp;B. WhatsApp oder Google-Bewertungen) führen erst nach einem Klick zu den jeweiligen Anbietern.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-list">
		<h2 id="cookie-list">6. Cookie-Liste</h2>
		<p>Die konkrete Cookie-Liste kann je nach eingesetzten Tools und Browser variieren. Typische Kategorien:</p>
		<ul>
			<li><strong>Notwendig:</strong> Betrieb der Website, Sicherheit, Speicherung der Cookie-Einstellungen</li>
			<li><strong>Statistik:</strong> derzeit nicht verwendet</li>
			<li><strong>Marketing:</strong> derzeit nicht verwendet</li>
		</ul>
		<p>Wenn Sie ein Consent-Tool nutzen, finden Sie dort ggf. eine aktuelle Auflistung der erkannten Cookies.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-consent">
		<h2 id="cookie-consent">7. Einwilligung</h2>
		<p>Technisch notwendige Cookies können ohne Einwilligung gesetzt werden, soweit dies zur Bereitstellung der Website erforderlich ist.</p>
		<p>Für optionale Cookies (z.&nbsp;B. Statistik oder Marketing) holen wir — sofern solche Dienste eingesetzt werden — Ihre Einwilligung über ein Cookie-Banner ein. Sie können Ihre Einwilligung jederzeit widerrufen oder ändern.</p>
		<p>Rechtsgrundlagen sind insbesondere § 25 Abs. 1 und Abs. 2 TDDDG sowie Art. 6 Abs. 1 lit. a bzw. lit. f DSGVO.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-rights">
		<h2 id="cookie-rights">8. Ihre Rechte bezüglich personenbezogener Daten</h2>
		<p>Ihnen stehen unter den gesetzlichen Voraussetzungen insbesondere folgende Rechte zu:</p>
		<ul>
			<li>Recht auf Auskunft</li>
			<li>Recht auf Berichtigung</li>
			<li>Recht auf Löschung</li>
			<li>Recht auf Einschränkung der Verarbeitung</li>
			<li>Recht auf Widerspruch</li>
			<li>Recht auf Beschwerde bei einer Aufsichtsbehörde</li>
		</ul>
		<p>Details finden Sie in unserer <a href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>">Datenschutzerklärung</a>.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-manage">
		<h2 id="cookie-manage">9. Cookies aktivieren, deaktivieren und löschen</h2>
		<p>Sie können Cookies in den Einstellungen Ihres Browsers verwalten, blockieren oder löschen. Bitte beachten Sie: Wenn Sie technisch notwendige Cookies deaktivieren, kann die Website möglicherweise nicht mehr vollständig funktionieren.</p>
		<p>Sofern ein Cookie-Banner eingesetzt wird, können Sie Ihre Auswahl dort erneut anpassen.</p>
	</section>

	<section class="legal-page__section" aria-labelledby="cookie-contact">
		<h2 id="cookie-contact">10. Kontakt</h2>
		<p>Bei Fragen zu Cookies und Datenschutz erreichen Sie uns unter:</p>
		<p>
			<strong><?php echo $company; ?></strong><br>
			Am Rang 9<br>
			95615 Marktredwitz<br>
			Deutschland
		</p>
		<p>
			Telefon: <a href="<?php echo $tel; ?>"><?php echo $phone; ?></a><br>
			E-Mail: <a href="mailto:<?php echo esc_attr( site_data( 'contact_email' ) ); ?>"><?php echo $email; ?></a>
		</p>
	</section>
	<?php
	return (string) ob_get_clean();
}
