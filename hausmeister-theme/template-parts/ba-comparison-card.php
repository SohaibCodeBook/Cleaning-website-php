<?php
/**
 * Before/After comparison card partial.
 *
 * Expects $ba_index (int).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

$i = isset( $args['ba_index'] ) ? (int) $args['ba_index'] : ( isset( $ba_index ) ? (int) $ba_index : 0 );

if ( $i < 1 || $i > 5 ) {
	return;
}

$category_defaults = array(
	1 => 'treppenhaus',
	2 => 'gruen',
	3 => 'fassade',
	4 => 'glas',
	5 => 'winter',
);
$category = page_home( "ba_{$i}_category" );
if ( $category === '' && isset( $category_defaults[ $i ] ) ) {
	$category = $category_defaults[ $i ];
}
$ba_files = array(
	1 => array( 'before' => 'ba/treppenhaus-before.jpg', 'after' => 'ba/treppenhaus-after.jpg' ),
	2 => array( 'before' => 'ba/gruen-before.jpg', 'after' => 'ba/gruen-after.jpg' ),
	3 => array( 'before' => 'ba/fassade-before.jpg', 'after' => 'ba/fassade-after.jpg' ),
	4 => array( 'before' => 'ba/glas-before.jpg', 'after' => 'ba/glas-after.jpg' ),
	5 => array( 'before' => 'ba/winter-before.jpg', 'after' => 'ba/winter-after.jpg' ),
);
$fallback = isset( $ba_files[ $i ] ) ? $ba_files[ $i ] : array( 'before' => '', 'after' => '' );
$before   = hausmeister_get_image_url( "ba_{$i}_before", $fallback['before'] );
$after    = hausmeister_get_image_url( "ba_{$i}_after", $fallback['after'] );
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
