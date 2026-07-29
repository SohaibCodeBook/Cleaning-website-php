<?php
/**
 * Template Name: Über uns
 * About page — Haus und Objektbetreuung.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php echo esc_html( page_about( 'page_title', get_the_title() ) ); ?></h1>
		<p class="section-subtitle"><?php echo esc_html( page_about( 'page_subtitle' ) ); ?></p>
	</div>
</div>

<div class="page-content">
	<section class="about-story js-reveal" data-reveal-root aria-label="<?php esc_attr_e( 'Unsere Geschichte', 'hausmeister-theme' ); ?>">
		<div class="container-theme">
			<div class="about-story__grid">
				<div class="about-story__content">
					<span class="section-label"><?php echo esc_html( site_data( 'company_name' ) ); ?></span>
					<h2 class="section-header__title">
						<?php echo esc_html( page_about( 'about_story_heading', __( 'Unsere Geschichte', 'hausmeister-theme' ) ) ); ?>
						<span class="teal-period">.</span>
					</h2>
					<p class="about-story__text">
						<?php echo wp_kses_post( wpautop( page_about( 'intro_text' ) ) ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="why-us" data-why-us data-reveal-root aria-label="<?php esc_attr_e( 'Warum Sie uns wählen', 'hausmeister-theme' ); ?>">
		<div class="container-theme">
			<div class="why-us__grid">
				<div>
					<span class="why-us__label section-label" data-reveal>
						<?php echo esc_html( page_about( 'about_why_label', __( 'Warum wir', 'hausmeister-theme' ) ) ); ?>
					</span>
					<h2 class="why-us__title" data-reveal>
						<?php echo esc_html( page_about( 'about_why_heading', __( 'Ihre Immobilie in guten Händen', 'hausmeister-theme' ) ) ); ?>
						<span class="teal-period">.</span>
					</h2>
					<p class="why-us__intro" data-reveal>
						<?php echo esc_html( page_about( 'about_why_intro', '' ) ); ?>
					</p>

					<div class="why-us__pillars" role="list">
						<?php
						$initial_quote = page_about( 'about_why_1_quote', '' );
						for ( $i = 1; $i <= 3; $i++ ) :
							$is_active      = 1 === $i;
							$pillar_icon    = page_about( 'about_why_' . $i . '_icon', '' );
							$pillar_title   = page_about( 'about_why_' . $i . '_title', '' );
							$pillar_desc    = page_about( 'about_why_' . $i . '_description', '' );
							$pillar_quote   = page_about( 'about_why_' . $i . '_quote', '' );
							$aria_selected  = $is_active ? 'true' : 'false';
							$classes        = 'why-pillar' . ( $is_active ? ' is-active' : '' );
							?>
							<button
								type="button"
								class="<?php echo esc_attr( $classes ); ?>"
								data-why-pillar
								aria-selected="<?php echo esc_attr( $aria_selected ); ?>"
								data-quote="<?php echo esc_attr( $pillar_quote ); ?>"
							>
								<span class="why-pillar__indicator" aria-hidden="true"></span>
								<span class="why-pillar__num" aria-hidden="true"><?php echo esc_html( (string) $i ); ?></span>
								<span class="why-pillar__icon" aria-hidden="true">
									<i class="<?php echo esc_attr( $pillar_icon ); ?>"></i>
								</span>
								<span class="why-pillar__body">
									<h3 class="why-pillar__title"><?php echo esc_html( $pillar_title ); ?></h3>
									<p class="why-pillar__desc"><?php echo esc_html( $pillar_desc ); ?></p>
								</span>
							</button>
						<?php endfor; ?>
					</div>
				</div>

				<div class="why-us__visual">
					<div class="why-us__image-frame">
						<div class="why-us__image-accent" aria-hidden="true"></div>
						<div class="why-us__image-wrap">
							<?php
							$why_image = hausmeister_get_image_url( 'about_why_image', 'why-us.jpg' );
							if ( $why_image ) :
								?>
								<img src="<?php echo esc_url( $why_image ); ?>" class="why-us__image" alt="" loading="lazy" />
							<?php endif; ?>
						</div>

						<figure class="why-us__quote-card">
							<p data-why-quote-text><?php echo esc_html( $initial_quote ); ?></p>
							<?php if ( page_about( 'about_why_quote_author', '' ) ) : ?>
								<cite><?php echo esc_html( page_about( 'about_why_quote_author' ) ); ?></cite>
							<?php endif; ?>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-values" aria-label="<?php esc_attr_e( 'Unsere Werte', 'hausmeister-theme' ); ?>">
		<div class="container-theme">
			<div class="section-header section-header--center">
				<span class="section-label"><?php echo esc_html( page_about( 'about_values_heading', __( 'Unsere Werte', 'hausmeister-theme' ) ) ); ?></span>
				<h2 class="section-header__title">
					<?php echo esc_html( page_about( 'about_values_title', __( 'Wofür wir stehen', 'hausmeister-theme' ) ) ); ?>
					<span class="teal-period">.</span>
				</h2>
			</div>

			<div class="features-grid mt-5">
				<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
					<div class="feature-item">
						<div class="feature-icon">
							<i class="<?php echo esc_attr( page_about( 'value_' . $i . '_icon' ) ); ?>" aria-hidden="true"></i>
						</div>
						<h3><?php echo esc_html( page_about( 'value_' . $i . '_title' ) ); ?></h3>
						<p><?php echo esc_html( page_about( 'value_' . $i . '_description' ) ); ?></p>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<section class="about-process" aria-label="<?php esc_attr_e( 'Unser Prozess', 'hausmeister-theme' ); ?>">
		<div class="container-theme">
			<div class="section-header section-header--center">
				<span class="section-label"><?php echo esc_html( page_about( 'about_process_heading', __( 'So arbeiten wir', 'hausmeister-theme' ) ) ); ?></span>
				<h2 class="section-header__title">
					<?php echo esc_html( page_about( 'about_process_title', __( 'Ein klarer Ablauf', 'hausmeister-theme' ) ) ); ?>
					<span class="teal-period">.</span>
				</h2>
				<p class="section-header__subtitle"><?php echo esc_html( page_about( 'about_process_subtitle', '' ) ); ?></p>
			</div>

			<div class="about-process__grid">
				<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
					<div class="about-process__step">
						<div class="about-process__num" aria-hidden="true"><?php echo esc_html( (string) $i ); ?></div>
						<?php if ( page_about( 'about_process_' . $i . '_icon', '' ) ) : ?>
							<div class="about-process__icon" aria-hidden="true">
								<i class="<?php echo esc_attr( page_about( 'about_process_' . $i . '_icon' ) ); ?>"></i>
							</div>
						<?php endif; ?>
						<h3 class="about-process__title"><?php echo esc_html( page_about( 'about_process_' . $i . '_title', '' ) ); ?></h3>
						<p class="about-process__desc"><?php echo esc_html( page_about( 'about_process_' . $i . '_description', '' ) ); ?></p>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<?php
	$certs = array();
	for ( $i = 1; $i <= 6; $i++ ) {
		$c = trim( (string) page_about( 'about_cert_' . $i, '' ) );
		if ( $c !== '' ) {
			$certs[] = $c;
		}
	}
	?>

	<?php if ( ! empty( $certs ) ) : ?>
		<section class="about-certifications" aria-label="<?php esc_attr_e( 'Zertifikate & Mitgliedschaften', 'hausmeister-theme' ); ?>">
			<div class="container-theme">
				<div class="section-header section-header--center">
					<span class="section-label"><?php echo esc_html( page_about( 'about_certs_heading', __( 'Zertifikate & Mitgliedschaften', 'hausmeister-theme' ) ) ); ?></span>
					<h2 class="section-header__title">
						<?php echo esc_html( page_about( 'about_certs_title', __( 'Nachweise für Qualität', 'hausmeister-theme' ) ) ); ?>
						<span class="teal-period">.</span>
					</h2>
				</div>

				<div class="about-certifications__list" role="list">
					<?php foreach ( $certs as $cert ) : ?>
						<span class="about-certifications__badge" role="listitem">
							<?php echo esc_html( $cert ); ?>
						</span>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</div>

<?php
get_footer();
