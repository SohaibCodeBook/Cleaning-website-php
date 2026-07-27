<?php
/**
 * Single post template (blog-ready).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php the_title(); ?></h1>
		<p class="section-subtitle">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</p>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<article <?php post_class( 'entry-content' ); ?>>
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</article>
	</div>
</div>

<?php
get_footer();
