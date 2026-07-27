<?php
/**
 * Before/After comparison card partial.
 *
 * Expects $ba_index (int).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

if ( empty( $ba_index ) ) {
	return;
}

$i        = (int) $ba_index;
$category = page_home( "ba_{$i}_category" );
$before   = hausmeister_get_image_url( "ba_{$i}_before" );
$after    = hausmeister_get_image_url( "ba_{$i}_after" );
$title    = page_home( "ba_{$i}_title" );
?>

<article class="ba-card" data-ba-card data-ba-category="<?php echo esc_attr( $category ); ?>">
	<div class="ba-card__header">
		<span class="ba-card__tag"><?php echo esc_html( hausmeister_get_ba_category_label( $category ) ); ?></span>
		<h3 class="ba-card__title"><?php echo esc_html( $title ); ?></h3>
		<p class="ba-card__desc"><?php echo esc_html( page_home( "ba_{$i}_description" ) ); ?></p>
		<div class="ba-card__meta">
			<i class="fa-solid fa-location-dot" aria-hidden="true"></i>
			<span><?php echo esc_html( page_home( "ba_{$i}_location" ) ); ?></span>
		</div>
	</div>

	<div class="ba-card__slider" data-ba-slider>
		<div class="ba-card__frame" data-ba-frame>
			<img
				class="ba-card__img ba-card__img--after"
				src="<?php echo esc_url( $after ); ?>"
				alt="<?php echo esc_attr( $title ); ?> — <?php esc_attr_e( 'Nachher', 'hausmeister-theme' ); ?>"
				loading="lazy"
				draggable="false"
			>
			<div class="ba-card__before" data-ba-before-layer style="width:50%">
				<img
					class="ba-card__img ba-card__img--before"
					data-ba-img-before
					src="<?php echo esc_url( $before ); ?>"
					alt="<?php echo esc_attr( $title ); ?> — <?php esc_attr_e( 'Vorher', 'hausmeister-theme' ); ?>"
					loading="lazy"
					draggable="false"
				>
			</div>
			<div class="ba-card__handle" data-ba-handle role="slider" aria-label="<?php esc_attr_e( 'Vorher-Nachher-Vergleich', 'hausmeister-theme' ); ?>" aria-valuemin="5" aria-valuemax="95" aria-valuenow="50" tabindex="0">
				<span class="ba-card__handle-line" aria-hidden="true"></span>
				<span class="ba-card__handle-btn" aria-hidden="true">
					<i class="fa-solid fa-arrows-left-right"></i>
				</span>
			</div>
			<span class="ba-card__label ba-card__label--before"><?php esc_html_e( 'Vorher', 'hausmeister-theme' ); ?></span>
			<span class="ba-card__label ba-card__label--after"><?php esc_html_e( 'Nachher', 'hausmeister-theme' ); ?></span>
		</div>
	</div>
</article>
