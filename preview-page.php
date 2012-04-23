<?php
/**
 * The template used for displaying page content in preview loops
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("preview"); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<? the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?
	$preview_post_id = get_the_ID();
	sfhiv_draw_menu(get_children(array(
		'post_parent' => $preview_post_id,
		)));
	do_action("sfhiv-preview-menu");	// Loose document scope after this line?
	sfhiv_draw_menu(array(
			get_post($preview_post_id),
		),array('selected_items' => array($preview_post_id)));
	?>
	
</article><!-- #post-<?php the_ID(); ?> -->