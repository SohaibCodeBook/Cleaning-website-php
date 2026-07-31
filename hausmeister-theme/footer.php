<?php
/**
 * Footer template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

</main><!-- .site-main -->

<?php
$hausmeister_footer_about_page = get_page_by_path( 'ueber-uns', OBJECT, 'page' );
$hausmeister_footer_contact_page = get_page_by_path( 'kontakt', OBJECT, 'page' );
$hausmeister_footer_impressum_page = get_page_by_path( 'impressum', OBJECT, 'page' );
$hausmeister_footer_datenschutz_page = get_page_by_path( 'datenschutz', OBJECT, 'page' );
$hausmeister_footer_cookie_page = get_page_by_path( 'cookie-richtlinie', OBJECT, 'page' );
?>

<footer class="site-footer">
	<div class="container-theme">
		<div class="footer-grid">
			<div class="footer-col">
				<div class="footer-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
						<img
							class="logo-footer-img"
							src="<?php echo esc_url( hausmeister_theme_image( 'footer logo no-bg.png' ) ); ?>"
							alt="<?php echo esc_attr( site_data( 'company_name' ) ); ?>"
							loading="eager"
							decoding="async"
						>
					</a>
				</div>
				<p><?php echo esc_html( site_data( 'footer_about' ) ); ?></p>
				<?php if ( site_data( 'social_facebook' ) || site_data( 'social_instagram' ) || site_data( 'social_linkedin' ) ) : ?>
				<div class="footer-social">
					<?php if ( site_data( 'social_facebook' ) ) : ?>
						<a href="<?php echo esc_url( site_data( 'social_facebook' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
							<i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( site_data( 'social_instagram' ) ) : ?>
						<a href="<?php echo esc_url( site_data( 'social_instagram' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
							<i class="fa-brands fa-instagram" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( site_data( 'social_linkedin' ) ) : ?>
						<a href="<?php echo esc_url( site_data( 'social_linkedin' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
							<i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Leistungen', 'hausmeister-theme' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'service_1_url' ) ) ); ?>"><?php echo esc_html( page_home( 'service_1_title' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'service_2_url' ) ) ); ?>"><?php echo esc_html( page_home( 'service_2_title' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'service_3_url' ) ) ); ?>"><?php echo esc_html( page_home( 'service_3_title' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'service_4_url' ) ) ); ?>"><?php echo esc_html( page_home( 'service_4_title' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( hausmeister_theme_url( page_home( 'service_5_url' ) ) ); ?>"><?php echo esc_html( page_home( 'service_5_title' ) ); ?></a></li>
				</ul>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Unternehmen', 'hausmeister-theme' ); ?></h4>
				<ul class="footer-col__links">
					<li>
						<?php if ( $hausmeister_footer_about_page ) : ?>
							<a href="<?php echo esc_url( get_permalink( $hausmeister_footer_about_page->ID ) ); ?>"><?php echo esc_html__( 'Über uns', 'hausmeister-theme' ); ?></a>
						<?php else : ?>
							<span class="footer-policy--disabled"><?php echo esc_html__( 'Über uns', 'hausmeister-theme' ); ?></span>
						<?php endif; ?>
					</li>
					<li>
						<?php if ( $hausmeister_footer_contact_page ) : ?>
							<a href="<?php echo esc_url( get_permalink( $hausmeister_footer_contact_page->ID ) ); ?>"><?php echo esc_html__( 'Kontakt', 'hausmeister-theme' ); ?></a>
						<?php else : ?>
							<span class="footer-policy--disabled"><?php echo esc_html__( 'Kontakt', 'hausmeister-theme' ); ?></span>
						<?php endif; ?>
					</li>
				</ul>
				<ul class="footer-col__contact">
					<li><i class="fa-solid fa-location-dot me-2" aria-hidden="true"></i><?php echo esc_html( site_data( 'address' ) ); ?></li>
					<?php if ( site_data( 'whatsapp' ) ) : ?>
					<li>
						<i class="fa-brands fa-whatsapp me-2" aria-hidden="true"></i>
						<a href="<?php echo esc_url( hausmeister_whatsapp_link( site_data( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( site_data( 'whatsapp' ) ); ?>
						</a>
					</li>
					<?php endif; ?>
					<li><i class="fa-solid fa-envelope me-2" aria-hidden="true"></i><a href="mailto:<?php echo esc_attr( site_data( 'contact_email' ) ); ?>"><?php echo esc_html( site_data( 'contact_email' ) ); ?></a></li>
				</ul>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Rechtliches', 'hausmeister-theme' ); ?></h4>
				<ul>
					<li>
						<?php if ( $hausmeister_footer_impressum_page ) : ?>
							<a href="<?php echo esc_url( get_permalink( $hausmeister_footer_impressum_page->ID ) ); ?>"><?php echo esc_html__( 'Impressum', 'hausmeister-theme' ); ?></a>
						<?php else : ?>
							<span class="footer-policy--disabled"><?php echo esc_html__( 'Impressum', 'hausmeister-theme' ); ?></span>
						<?php endif; ?>
					</li>
					<li>
						<?php if ( $hausmeister_footer_datenschutz_page ) : ?>
							<a href="<?php echo esc_url( get_permalink( $hausmeister_footer_datenschutz_page->ID ) ); ?>"><?php echo esc_html__( 'Datenschutz', 'hausmeister-theme' ); ?></a>
						<?php else : ?>
							<span class="footer-policy--disabled"><?php echo esc_html__( 'Datenschutz', 'hausmeister-theme' ); ?></span>
						<?php endif; ?>
					</li>
					<li>
						<?php if ( $hausmeister_footer_cookie_page ) : ?>
							<a href="<?php echo esc_url( get_permalink( $hausmeister_footer_cookie_page->ID ) ); ?>"><?php echo esc_html__( 'Cookie-Richtlinie', 'hausmeister-theme' ); ?></a>
						<?php else : ?>
							<span class="footer-policy--disabled"><?php echo esc_html__( 'Cookie-Richtlinie', 'hausmeister-theme' ); ?></span>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-bottom-left">
				<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( site_data( 'company_name' ) ); ?>. <?php echo esc_html( site_data( 'footer_copyright' ) ); ?></p>
			</div>
			<div class="footer-bottom-right"></div>
		</div>
	</div>
</footer>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
