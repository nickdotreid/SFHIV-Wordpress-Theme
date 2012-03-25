<?php
/**
 * Template Name: Splash page
 * Description: Template for pages that makes preview boxes for all child pages
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<div id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php
$children = get_pages(array(
	"parent"=>get_the_ID(),
	"hierarchical" => 0,
	"sort_column" => 'menu_order,post_title',
	));
?>
<nav id="splash" class="three-column">
	<div class="divider"></div>
	<div class="" style="display:block;clear:both;">
<? foreach($children as $child):	?>
<? setup_postdata($child);
$post = $child;	# why both?
	?>
<?php get_template_part( 'preview', 'page' ); ?>
<?	endforeach;	?>
<br class="clear"/>
</div>
	<br class="clear" />
</nav>
<? the_post(); #reset $post ?>
<?php get_footer(); ?>