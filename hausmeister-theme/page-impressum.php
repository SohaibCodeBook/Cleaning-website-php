<?php
/**
 * Template Name: Impressum
 * Legal notice page (German Impressum).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php esc_html_e( 'Impressum', 'hausmeister-theme' ); ?></h1>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="entry-content legal-page">
			<section class="legal-page__section" aria-labelledby="impressum-ddg">
				<h2 id="impressum-ddg"><?php esc_html_e( 'Angaben gemäß § 5 DDG', 'hausmeister-theme' ); ?></h2>
				<p>
					<strong><?php echo esc_html( site_data( 'company_name' ) ); ?></strong><br>
					<?php esc_html_e( 'Inhaber: Sascha Becker', 'hausmeister-theme' ); ?>
				</p>
				<p>
					Am Rang 9<br>
					95615 Marktredwitz<br>
					Deutschland
				</p>
				<p>
					<strong><?php esc_html_e( 'Telefon:', 'hausmeister-theme' ); ?></strong>
					<a href="<?php echo esc_attr( hausmeister_tel_link( '+49 9231 7960386' ) ); ?>">+49 9231 7960386</a><br>
					<strong><?php esc_html_e( 'E-Mail:', 'hausmeister-theme' ); ?></strong>
					<a href="mailto:info@objektbetreuung-fichtelgebirge.de">info@objektbetreuung-fichtelgebirge.de</a>
				</p>
			</section>

			<section class="legal-page__section" aria-labelledby="impressum-mstv">
				<h2 id="impressum-mstv"><?php esc_html_e( 'Verantwortlich für den Inhalt gemäß § 18 Abs. 2 MStV', 'hausmeister-theme' ); ?></h2>
				<p>
					Sascha Becker<br>
					Am Rang 9<br>
					95615 Marktredwitz<br>
					Deutschland
				</p>
			</section>

			<section class="legal-page__section" aria-labelledby="impressum-ust">
				<h2 id="impressum-ust"><?php esc_html_e( 'Umsatzsteuer-ID', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Umsatzsteuer-Identifikationsnummer gemäß § 27a Umsatzsteuergesetz:', 'hausmeister-theme' ); ?></p>
				<p><strong>DE459999830</strong></p>
			</section>

			<section class="legal-page__section" aria-labelledby="impressum-hr">
				<h2 id="impressum-hr"><?php esc_html_e( 'Handelsregister', 'hausmeister-theme' ); ?></h2>
				<p><?php esc_html_e( 'Kein Eintrag im Handelsregister.', 'hausmeister-theme' ); ?></p>
			</section>

			<section class="legal-page__section" aria-labelledby="impressum-odr">
				<h2 id="impressum-odr"><?php esc_html_e( 'Streitschlichtung / Verbraucherschlichtung', 'hausmeister-theme' ); ?></h2>
				<p>
					<?php esc_html_e( 'Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:', 'hausmeister-theme' ); ?>
					<br>
					<a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>
				</p>
				<p><?php esc_html_e( 'Wir sind nicht verpflichtet und nicht bereit, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.', 'hausmeister-theme' ); ?></p>
			</section>
		</div>
	</div>
</div>

<?php
get_footer();
