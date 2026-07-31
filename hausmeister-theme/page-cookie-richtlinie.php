<?php
/**
 * Template Name: Cookie-Richtlinie
 * Cookie policy page — content is editable in WordPress (Seiten → Cookie-Richtlinie).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();

$has_editor_content = (bool) trim( (string) get_post_field( 'post_content', get_the_ID() ) );
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Cookie-Richtlinie', 'hausmeister-theme' ) ); ?></h1>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="entry-content legal-page">
			<?php if ( $has_editor_content ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			<?php else : ?>
				<?php echo hausmeister_get_default_cookie_policy_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
