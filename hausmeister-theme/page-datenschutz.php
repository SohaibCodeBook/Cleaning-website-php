<?php
/**
 * Template Name: Datenschutz
 * Privacy policy page (German Datenschutzerklärung).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php esc_html_e( 'Datenschutzerklärung', 'hausmeister-theme' ); ?></h1>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="entry-content legal-page">
			<section class="legal-page__section" aria-labelledby="ds-overview">
				<h2 id="ds-overview"><?php esc_html_e( '1. Datenschutz auf einen Blick', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Der Schutz Ihrer persönlichen Daten ist uns ein wichtiges Anliegen. Nachfolgend informieren wir Sie darüber, welche personenbezogenen Daten beim Besuch unserer Website erhoben werden, zu welchem Zweck diese verarbeitet werden und welche Rechte Ihnen zustehen.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-controller">
				<h2 id="ds-controller"><?php esc_html_e( '2. Verantwortlicher', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Verantwortlich für die Datenverarbeitung auf dieser Website ist:', 'hausmeister-theme' ); ?></p>
				<p>
					<strong><?php echo esc_html( site_data( 'company_name' ) ); ?></strong><br>
					<?php esc_html_e( 'Inhaber: Sascha Becker', 'hausmeister-theme' ); ?><br>
					Am Rang 9<br>
					95615 Marktredwitz<br>
					Deutschland
				</p>
				<p>
					<?php esc_html_e( 'Telefon:', 'hausmeister-theme' ); ?>
					<a href="<?php echo esc_attr( hausmeister_tel_link( '+49 9231 7960386' ) ); ?>">+49 9231 7960386</a><br>
					<?php esc_html_e( 'E-Mail:', 'hausmeister-theme' ); ?>
					<a href="mailto:info@objektbetreuung-fichtelgebirge.de">info@objektbetreuung-fichtelgebirge.de</a>
				</p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-hosting">
				<h2 id="ds-hosting"><?php esc_html_e( '3. Hosting', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Diese Website wird bei Hostinger gehostet.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Beim Besuch dieser Website werden durch den Hosting-Anbieter automatisch Informationen in sogenannten Server-Logfiles erfasst. Hierzu gehören insbesondere:', 'hausmeister-theme' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'IP-Adresse', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Datum und Uhrzeit der Anfrage', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Browsertyp und Browserversion', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Betriebssystem', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Referrer-URL', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Besuchte Seiten', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Zugriffsstatus', 'hausmeister-theme' ); ?></li>
				</ul>
				<p><?php esc_html_e( 'Diese Daten dienen der technischen Bereitstellung der Website sowie der Gewährleistung der Sicherheit und Stabilität des Angebots. Eine Zusammenführung dieser Daten mit anderen Datenquellen erfolgt nicht.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-form">
				<h2 id="ds-form"><?php esc_html_e( '4. Kontaktformular', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Wenn Sie unser Kontakt- oder Angebotsformular nutzen, werden die von Ihnen eingegebenen Daten verarbeitet, um Ihre Anfrage zu bearbeiten.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Hierzu können insbesondere folgende Angaben gehören:', 'hausmeister-theme' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Gewünschte Dienstleistungen', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Objektart', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Objektgröße (optional)', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Ort (optional)', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Name', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'E-Mail-Adresse', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Telefonnummer', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Nachricht', 'hausmeister-theme' ); ?></li>
				</ul>
				<p>
					<?php esc_html_e( 'Die übermittelten Daten werden ausschließlich zur Bearbeitung Ihrer Anfrage verwendet und per E-Mail an', 'hausmeister-theme' ); ?>
					<a href="mailto:info@objektbetreuung-fichtelgebirge.de">info@objektbetreuung-fichtelgebirge.de</a>
					<?php esc_html_e( 'übermittelt.', 'hausmeister-theme' ); ?>
				</p>
				<p><?php esc_html_e( 'Die Verarbeitung erfolgt gemäß Art. 6 Abs. 1 lit. b DSGVO sowie Art. 6 Abs. 1 lit. f DSGVO.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-email-phone">
				<h2 id="ds-email-phone"><?php esc_html_e( '5. Kontaktaufnahme per E-Mail oder Telefon', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Wenn Sie uns per E-Mail oder telefonisch kontaktieren, werden Ihre Angaben zur Bearbeitung Ihrer Anfrage verarbeitet.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO bzw. Art. 6 Abs. 1 lit. f DSGVO.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-whatsapp">
				<h2 id="ds-whatsapp"><?php esc_html_e( '6. Kontakt über WhatsApp', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Sie haben die Möglichkeit, uns über WhatsApp zu kontaktieren.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Bei der Nutzung von WhatsApp werden personenbezogene Daten an WhatsApp Ireland Limited übermittelt. Bitte beachten Sie die Datenschutzbestimmungen von WhatsApp.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Die Kommunikation erfolgt ausschließlich zur Bearbeitung Ihrer Anfrage.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO bzw. Art. 6 Abs. 1 lit. f DSGVO.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-fonts">
				<h2 id="ds-fonts"><?php esc_html_e( '7. Google Fonts', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Diese Website verwendet Google Fonts zur einheitlichen Darstellung von Schriftarten.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Beim Aufruf der Website kann eine Verbindung zu Servern von Google hergestellt werden. Dabei kann insbesondere Ihre IP-Adresse an Google übermittelt werden.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-fa">
				<h2 id="ds-fa"><?php esc_html_e( '8. Font Awesome', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Diese Website nutzt Font Awesome zur Darstellung von Symbolen.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Beim Laden der Schriftarten oder Icons kann eine Verbindung zu den Servern des jeweiligen Anbieters hergestellt werden.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Dabei können technische Informationen, insbesondere Ihre IP-Adresse, verarbeitet werden.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-bootstrap">
				<h2 id="ds-bootstrap"><?php esc_html_e( '9. Bootstrap CDN', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Zur technischen Darstellung der Website werden Dateien des Bootstrap-CDN eingebunden.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Beim Laden dieser Dateien kann eine Verbindung zum CDN-Anbieter hergestellt werden. Dabei können technische Daten wie die IP-Adresse verarbeitet werden.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-cookies">
				<h2 id="ds-cookies"><?php esc_html_e( '10. Cookies', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Diese Website verwendet Cookies.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Einige Cookies sind technisch erforderlich, um die Website ordnungsgemäß bereitzustellen.', 'hausmeister-theme' ); ?></p>
				<p><?php esc_html_e( 'Weitere Informationen zu optionalen Cookies und gegebenenfalls eingesetzten Einwilligungsdiensten werden ergänzt, sofern entsprechende Dienste auf dieser Website verwendet werden.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-storage">
				<h2 id="ds-storage"><?php esc_html_e( '11. Speicherdauer', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Personenbezogene Daten werden nur so lange gespeichert, wie dies zur Bearbeitung Ihrer Anfrage oder aufgrund gesetzlicher Aufbewahrungspflichten erforderlich ist.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-rights">
				<h2 id="ds-rights"><?php esc_html_e( '12. Ihre Rechte', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen insbesondere folgende Rechte:', 'hausmeister-theme' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Auskunft über Ihre gespeicherten Daten', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Berichtigung unrichtiger Daten', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Löschung Ihrer Daten', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Einschränkung der Verarbeitung', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Datenübertragbarkeit', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Widerspruch gegen die Verarbeitung personenbezogener Daten', 'hausmeister-theme' ); ?></li>
					<li><?php esc_html_e( 'Widerruf einer erteilten Einwilligung mit Wirkung für die Zukunft', 'hausmeister-theme' ); ?></li>
				</ul>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-complaint">
				<h2 id="ds-complaint"><?php esc_html_e( '13. Beschwerderecht', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Sie haben das Recht, sich bei einer Datenschutzaufsichtsbehörde über die Verarbeitung Ihrer personenbezogenen Daten zu beschweren.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="ds-changes">
				<h2 id="ds-changes"><?php esc_html_e( '14. Änderungen dieser Datenschutzerklärung', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Wir behalten uns vor, diese Datenschutzerklärung anzupassen, damit sie stets den aktuellen rechtlichen Anforderungen entspricht oder um Änderungen unserer Leistungen auf der Website umzusetzen.', 'hausmeister-theme' ); ?></p>
			</section>
		</div>
	</div>
</div>

<?php
get_footer();
