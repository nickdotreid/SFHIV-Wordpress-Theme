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
	<?	sfhiv_draw_menu(array(
		get_post(get_the_ID())
		),array(
		'show_children' => true,
	));	?>
	<?	do_action("sfhiv-preview-menu");	?>
</article><!-- #post-<?php the_ID(); ?> -->