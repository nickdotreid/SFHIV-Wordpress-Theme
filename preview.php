<?php
/**
 * The template used for displaying page content in preview loops
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("preview"); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<? the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?	do_action("sfhiv-preview-menu");	?>
</article><!-- #post-<?php the_ID(); ?> -->