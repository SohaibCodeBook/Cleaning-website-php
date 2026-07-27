<?php
/**
 * Footer template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

</main><!-- .site-main -->

<footer class="site-footer">
	<div class="container-theme">
		<div class="footer-grid">
			<div class="footer-col">
				<h4><?php echo esc_html( site_data( 'company_name' ) ); ?></h4>
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
				<h4><?php esc_html_e( 'Kontakt', 'hausmeister-theme' ); ?></h4>
				<ul>
					<li><i class="fa-solid fa-location-dot me-2" aria-hidden="true"></i><?php echo esc_html( site_data( 'address' ) ); ?></li>
					<li><i class="fa-solid fa-phone me-2" aria-hidden="true"></i><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', site_data( 'phone' ) ) ); ?>"><?php echo esc_html( site_data( 'phone' ) ); ?></a></li>
					<li><i class="fa-solid fa-envelope me-2" aria-hidden="true"></i><a href="mailto:<?php echo esc_attr( site_data( 'contact_email' ) ); ?>"><?php echo esc_html( site_data( 'contact_email' ) ); ?></a></li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( site_data( 'company_name' ) ); ?>. <?php echo esc_html( site_data( 'footer_copyright' ) ); ?></p>
		</div>
	</div>
</footer>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
