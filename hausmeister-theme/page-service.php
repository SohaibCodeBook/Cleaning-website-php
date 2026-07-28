<?php
/**
 * Template Name: Einzelne Leistung
 * Single service page template for all 5 services.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

$service_index = hausmeister_get_service_index_from_page();

if ( ! $service_index ) {
	get_header();
	echo '<div class="container-theme section"><p>' . esc_html__( 'Diese Seite ist keiner Leistung zugeordnet. Bitte verwenden Sie die Leistungs-Unterseiten oder weisen Sie das Template „Einzelne Leistung“ einer Leistungsseite zu.', 'hausmeister-theme' ) . '</p></div>';
	get_footer();
	return;
}

$icon       = page_home( "service_{$service_index}_icon" );
$title      = page_home( "service_{$service_index}_title" );
$highlights = array_filter( array_map( 'trim', explode( "\n", page_service( $service_index, 'highlights' ) ) ) );

get_header();
?>

<section class="sp-hero">
	<div class="container-theme">
		<?php hausmeister_service_breadcrumbs( $service_index ); ?>

		<div class="sp-hero__grid">
			<div class="sp-hero__content">
				<div class="sp-badges">
					<?php for ( $b = 1; $b <= 3; $b++ ) : ?>
						<?php $badge = page_service( $service_index, "badge_{$b}" ); ?>
						<?php if ( $badge ) : ?>
							<span class="sp-badge"><?php echo esc_html( $badge ); ?></span>
						<?php endif; ?>
					<?php endfor; ?>
				</div>

				<h1 class="sp-hero__title"><?php echo esc_html( $title ); ?></h1>
				<p class="sp-hero__text"><?php echo esc_html( page_service( $service_index, 'hero_text' ) ); ?></p>

				<a href="<?php echo esc_url( hausmeister_theme_url( page_service( $service_index, 'hero_btn_url', '/kontakt/' ) ) ); ?>" class="btn btn--primary btn--lg btn--has-arrow">
					<span class="btn__text"><?php echo esc_html( page_service( $service_index, 'hero_btn_text', 'Kostenlos beraten lassen' ) ); ?></span>
					<svg class="btn__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
				</a>
			</div>

			<aside class="sp-hero__panel" aria-label="<?php esc_attr_e( 'Leistungsüberblick', 'hausmeister-theme' ); ?>">
				<div class="sp-hero__panel-icon">
					<i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
				</div>
				<h2 class="sp-hero__panel-title"><?php echo esc_html( $title ); ?></h2>
				<?php if ( ! empty( $highlights ) ) : ?>
					<ul class="sp-hero__highlights">
						<?php foreach ( $highlights as $line ) : ?>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
								<?php echo esc_html( $line ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</section>

<section class="sp-features">
	<div class="container-theme">
		<div class="section-header section-header--center sp-section-head">
			<span class="section-label"><?php echo esc_html( page_service( $service_index, 'features_label' ) ); ?></span>
			<h2 class="section-header__title"><?php echo esc_html( page_service( $service_index, 'features_heading' ) ); ?><span class="teal-period">.</span></h2>
		</div>

		<div class="sp-features__grid">
			<?php for ( $f = 1; $f <= 6; $f++ ) : ?>
				<?php
				$feature_title = page_service( $service_index, "feature_{$f}_title" );
				if ( ! $feature_title ) {
					continue;
				}
				?>
				<article class="sp-feature-card<?php echo $f <= 2 ? ' sp-feature-card--wide' : ''; ?>">
					<div class="sp-feature-card__icon">
						<i class="<?php echo esc_attr( page_service( $service_index, "feature_{$f}_icon" ) ); ?>" aria-hidden="true"></i>
					</div>
					<h3><?php echo esc_html( $feature_title ); ?></h3>
					<p><?php echo esc_html( page_service( $service_index, "feature_{$f}_text" ) ); ?></p>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="sp-intro">
	<div class="container-theme">
		<div class="sp-intro__box">
			<p><?php echo esc_html( page_service( $service_index, 'intro_text' ) ); ?></p>
		</div>
	</div>
</section>

<section class="sp-process">
	<div class="container-theme">
		<div class="section-header sp-section-head">
			<span class="section-label"><?php echo esc_html( page_service( $service_index, 'process_label' ) ); ?></span>
			<h2 class="section-header__title"><?php echo esc_html( page_service( $service_index, 'process_heading' ) ); ?><span class="teal-period">.</span></h2>
		</div>

		<div class="sp-process__track">
			<?php for ( $s = 1; $s <= 4; $s++ ) : ?>
				<article class="sp-step">
					<span class="sp-step__num"><?php echo esc_html( sprintf( '%02d', $s ) ); ?></span>
					<h3><?php echo esc_html( page_service( $service_index, "step_{$s}_title" ) ); ?></h3>
					<p><?php echo esc_html( page_service( $service_index, "step_{$s}_text" ) ); ?></p>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="sp-sectors">
	<div class="container-theme">
		<div class="sp-sectors__box">
			<span class="section-label"><?php echo esc_html( page_service( $service_index, 'sectors_label' ) ); ?></span>
			<h2><?php echo esc_html( page_service( $service_index, 'sectors_heading' ) ); ?></h2>
			<div class="sp-sectors__tags">
				<?php foreach ( hausmeister_parse_tags( page_service( $service_index, 'sectors_list' ) ) as $sector ) : ?>
					<span class="sp-sector-tag"><?php echo esc_html( $sector ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="sp-faq" data-sp-faq>
	<div class="container-theme">
		<div class="section-header section-header--center sp-section-head">
			<span class="section-label"><?php echo esc_html( page_service( $service_index, 'faq_label' ) ); ?></span>
			<h2 class="section-header__title"><?php echo esc_html( page_service( $service_index, 'faq_heading' ) ); ?><span class="teal-period">.</span></h2>
		</div>

		<div class="sp-faq__list">
			<?php for ( $q = 1; $q <= 4; $q++ ) : ?>
				<?php
				$question = page_service( $service_index, "faq_{$q}_question" );
				$answer   = page_service( $service_index, "faq_{$q}_answer" );
				if ( ! $question || ! $answer ) {
					continue;
				}
				?>
				<details class="sp-faq__item">
					<summary class="sp-faq__question">
						<span><?php echo esc_html( sprintf( '%02d', $q ) ); ?> <?php echo esc_html( $question ); ?></span>
						<svg class="sp-faq__icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
					</summary>
					<div class="sp-faq__answer">
						<p><?php echo esc_html( $answer ); ?></p>
					</div>
				</details>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="sp-related">
	<div class="container-theme">
		<h2 class="sp-related__title"><?php echo esc_html( page_service( $service_index, 'related_heading' ) ); ?></h2>
		<div class="sp-related__grid">
			<?php foreach ( hausmeister_get_related_service_indexes( $service_index ) as $rel_index ) : ?>
				<a href="<?php echo esc_url( hausmeister_theme_url( page_home( "service_{$rel_index}_url" ) ) ); ?>" class="sp-related-card">
					<div class="sp-related-card__icon">
						<i class="<?php echo esc_attr( page_home( "service_{$rel_index}_icon" ) ); ?>" aria-hidden="true"></i>
					</div>
					<div>
						<h3><?php echo esc_html( page_home( "service_{$rel_index}_title" ) ); ?></h3>
						<p><?php echo esc_html( page_home( "service_{$rel_index}_subtitle" ) ); ?></p>
						<span class="sp-related-card__link"><?php echo esc_html( page_home( 'service_link_text' ) ); ?> &rarr;</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sp-cta">
	<div class="container-theme">
		<div class="sp-cta__box">
			<div class="sp-cta__content">
				<h2><?php echo esc_html( page_service( $service_index, 'cta_heading' ) ); ?></h2>
				<p><?php echo esc_html( page_service( $service_index, 'cta_text' ) ); ?></p>
			</div>
			<div class="sp-cta__actions">
				<a href="<?php echo esc_url( hausmeister_theme_url( '/kontakt/' ) ); ?>" class="btn btn--primary btn--lg">
					<?php echo esc_html( page_service( $service_index, 'hero_btn_text', 'Kostenlos beraten lassen' ) ); ?>
				</a>
				<a href="<?php echo esc_attr( hausmeister_tel_link( site_data( 'phone' ) ) ); ?>" class="sp-cta__phone">
					<i class="fa-solid fa-phone" aria-hidden="true"></i>
					<?php echo esc_html( site_data( 'phone' ) ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
