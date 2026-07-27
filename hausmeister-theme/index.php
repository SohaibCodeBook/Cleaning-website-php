<?php
/**
 * Main index template (fallback + blog archive ready).
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1><?php single_post_title(); ?></h1>
		<?php elseif ( is_archive() ) : ?>
			<h1><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<p class="section-subtitle">', '</p>' ); ?>
		<?php else : ?>
			<h1><?php esc_html_e( 'Beiträge', 'hausmeister-theme' ); ?></h1>
		<?php endif; ?>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<?php if ( have_posts() ) : ?>
			<div class="search-results">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'search-item' ); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
					</article>
					<?php
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Keine Beiträge gefunden.', 'hausmeister-theme' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
