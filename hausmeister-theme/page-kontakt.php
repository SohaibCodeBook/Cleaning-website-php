<?php
/**
 * Template Name: Kontakt
 * Contact page — full content to be built with reference design.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php echo esc_html( page_contact( 'page_title', get_the_title() ) ); ?></h1>
		<p class="section-subtitle"><?php echo esc_html( page_contact( 'page_subtitle' ) ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="row g-4">
			<div class="col-lg-5">
				<h3><?php esc_html_e( 'Kontaktinformationen', 'hausmeister-theme' ); ?></h3>
				<ul class="list-unstyled mt-3">
					<li class="mb-3">
						<i class="fa-solid fa-location-dot me-2 text-primary" aria-hidden="true"></i>
						<?php echo esc_html( site_data( 'address' ) ); ?>
					</li>
					<li class="mb-3">
						<i class="fa-solid fa-phone me-2 text-primary" aria-hidden="true"></i>
						<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', site_data( 'phone' ) ) ); ?>">
							<?php echo esc_html( site_data( 'phone' ) ); ?>
						</a>
					</li>
					<li class="mb-3">
						<i class="fa-solid fa-envelope me-2 text-primary" aria-hidden="true"></i>
						<a href="mailto:<?php echo esc_attr( site_data( 'contact_email' ) ); ?>">
							<?php echo esc_html( site_data( 'contact_email' ) ); ?>
						</a>
					</li>
				</ul>
				<p class="text-muted"><?php echo esc_html( page_contact( 'info_text' ) ); ?></p>
			</div>

			<div class="col-lg-7">
				<form class="contact-form" id="hausmeister-contact-form" method="post">
					<div class="row g-3">
						<div class="col-md-6 form-group">
							<label for="contact-name"><?php esc_html_e( 'Name', 'hausmeister-theme' ); ?> *</label>
							<input type="text" id="contact-name" name="name" required>
						</div>
						<div class="col-md-6 form-group">
							<label for="contact-email"><?php esc_html_e( 'E-Mail', 'hausmeister-theme' ); ?> *</label>
							<input type="email" id="contact-email" name="email" required>
						</div>
						<div class="col-md-6 form-group">
							<label for="contact-phone"><?php esc_html_e( 'Telefon', 'hausmeister-theme' ); ?></label>
							<input type="tel" id="contact-phone" name="phone">
						</div>
						<div class="col-md-6 form-group">
							<label for="contact-subject"><?php esc_html_e( 'Betreff', 'hausmeister-theme' ); ?></label>
							<input type="text" id="contact-subject" name="subject">
						</div>
						<div class="col-12 form-group">
							<label for="contact-message"><?php esc_html_e( 'Nachricht', 'hausmeister-theme' ); ?> *</label>
							<textarea id="contact-message" name="message" required></textarea>
						</div>
						<div class="col-12">
							<button type="submit" class="btn-primary">
								<?php echo esc_html( page_contact( 'form_submit_text' ) ); ?>
							</button>
						</div>
					</div>
					<div class="form-message" role="alert"></div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
