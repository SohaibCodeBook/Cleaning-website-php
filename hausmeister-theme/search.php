<?php
/**
 * Search results template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1>
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Suchergebnisse für: %s', 'hausmeister-theme' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
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
			<p><?php esc_html_e( 'Keine Ergebnisse gefunden. Bitte versuchen Sie eine andere Suche.', 'hausmeister-theme' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
