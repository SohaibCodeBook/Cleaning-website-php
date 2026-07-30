<?php
/**
 * Before/After comparison card partial.
 *
 * Expects $ba_index (int) and optional $ba_extra (bool).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

$i = isset( $args['ba_index'] ) ? (int) $args['ba_index'] : ( isset( $ba_index ) ? (int) $ba_index : 0 );
$is_extra = ! empty( $args['ba_extra'] );

if ( $i < 1 || $i > 12 ) {
	return;
}

$ba_files = array(
	1  => array( 'before' => 'ba/treppenhaus-before.jpg', 'after' => 'ba/treppenhaus-after.jpg' ),
	2  => array( 'before' => 'ba/gruen-before.jpg', 'after' => 'ba/gruen-after.jpg' ),
	3  => array( 'before' => 'ba/fassade-before.jpg', 'after' => 'ba/fassade-after.jpg' ),
	4  => array( 'before' => 'ba/glas-before.jpg', 'after' => 'ba/glas-after.jpg' ),
	5  => array( 'before' => 'ba/winter-before.jpg', 'after' => 'ba/winter-after.jpg' ),
	6  => array( 'before' => 'ba/treppenhaus-before.jpg', 'after' => 'ba/treppenhaus-after.jpg' ),
	7  => array( 'before' => 'ba/gruen-before.jpg', 'after' => 'ba/gruen-after.jpg' ),
	8  => array( 'before' => 'ba/fassade-before.jpg', 'after' => 'ba/fassade-after.jpg' ),
	9  => array( 'before' => 'ba/glas-before.jpg', 'after' => 'ba/glas-after.jpg' ),
	10 => array( 'before' => 'ba/winter-before.jpg', 'after' => 'ba/winter-after.jpg' ),
	11 => array( 'before' => 'ba/treppenhaus-before.jpg', 'after' => 'ba/treppenhaus-after.jpg' ),
	12 => array( 'before' => 'ba/gruen-before.jpg', 'after' => 'ba/gruen-after.jpg' ),
);
$fallback = isset( $ba_files[ $i ] ) ? $ba_files[ $i ] : array( 'before' => '', 'after' => '' );
$before   = hausmeister_get_image_url( "ba_{$i}_before", $fallback['before'] );
$after    = hausmeister_get_image_url( "ba_{$i}_after", $fallback['after'] );
$title    = page_home( "ba_{$i}_title" );
$alt_base = $title !== '' ? $title : sprintf(
	/* translators: %d: comparison number */
	__( 'Vorher-Nachher-Vergleich %d', 'hausmeister-theme' ),
	$i
);

$classes = 'ba-card';
if ( $is_extra ) {
	$classes .= ' ba-card--extra';
}
?>

<article class="<?php echo esc_attr( $classes ); ?>" data-ba-card<?php echo $is_extra ? ' data-ba-extra hidden' : ''; ?>>
	<div class="ba-card__slider" data-ba-slider>
		<div class="ba-card__frame" data-ba-frame>
			<img
				class="ba-card__img ba-card__img--after"
				src="<?php echo esc_url( $after ); ?>"
				alt="<?php echo esc_attr( $alt_base ); ?> — <?php esc_attr_e( 'Nachher', 'hausmeister-theme' ); ?>"
				loading="lazy"
				draggable="false"
			>
			<div class="ba-card__before" data-ba-before-layer style="width:50%">
				<img
					class="ba-card__img ba-card__img--before"
					data-ba-img-before
					src="<?php echo esc_url( $before ); ?>"
					alt="<?php echo esc_attr( $alt_base ); ?> — <?php esc_attr_e( 'Vorher', 'hausmeister-theme' ); ?>"
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
