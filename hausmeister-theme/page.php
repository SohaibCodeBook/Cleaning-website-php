<?php
/**
 * Generic page template.
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-header">
	<div class="container-theme">
		<h1><?php the_title(); ?></h1>
	</div>
</div>

<div class="page-content">
	<div class="container-theme">
		<div class="entry-content">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
