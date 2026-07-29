<?php
/**
 * Template Name: Kontakt
 * Contact page with multi-step quote form (M2A-inspired).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="contact-page">
	<div class="container-theme contact-page__intro">
		<p class="section-label"><?php echo esc_html( page_contact( 'page_title', __( 'Kontakt', 'hausmeister-theme' ) ) ); ?></p>
		<h1 class="contact-page__title">
			<?php esc_html_e( 'Sprechen Sie uns an.', 'hausmeister-theme' ); ?><span class="teal-period">.</span>
		</h1>
		<p class="contact-page__subtitle"><?php echo esc_html( page_contact( 'page_subtitle' ) ); ?></p>
	</div>

	<div class="container-theme">
		<div class="contact-page__grid">
			<div class="contact-page__form">
				<?php
				hausmeister_render_quote_form(
					array(
						'id'    => 'kontakt-quote-form',
						'title' => __( 'Nachricht senden', 'hausmeister-theme' ),
					)
				);
				?>
			</div>

			<aside class="contact-page__aside" aria-label="<?php esc_attr_e( 'Kontaktinformationen', 'hausmeister-theme' ); ?>">
				<h2 class="contact-page__aside-title"><?php esc_html_e( 'Kontaktinformationen', 'hausmeister-theme' ); ?></h2>
				<ul class="contact-page__info-list">
					<li>
						<i class="fa-solid fa-location-dot" aria-hidden="true"></i>
						<span><?php echo esc_html( site_data( 'address' ) ); ?></span>
					</li>
					<li>
						<i class="fa-solid fa-phone" aria-hidden="true"></i>
						<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', site_data( 'phone' ) ) ); ?>">
							<?php echo esc_html( site_data( 'phone' ) ); ?>
						</a>
					</li>
					<li>
						<i class="fa-solid fa-envelope" aria-hidden="true"></i>
						<a href="mailto:<?php echo esc_attr( site_data( 'contact_email' ) ); ?>">
							<?php echo esc_html( site_data( 'contact_email' ) ); ?>
						</a>
					</li>
				</ul>
				<p class="contact-page__aside-note"><?php echo esc_html( page_contact( 'info_text' ) ); ?></p>

				<div class="contact-page__trust">
					<span><i class="fa-solid fa-clock" aria-hidden="true"></i> <?php esc_html_e( 'Schnelle Rückmeldung', 'hausmeister-theme' ); ?></span>
					<span><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> <?php esc_html_e( 'Unverbindliche Beratung', 'hausmeister-theme' ); ?></span>
				</div>
			</aside>
		</div>
	</div>
</div>

<?php
get_footer();
