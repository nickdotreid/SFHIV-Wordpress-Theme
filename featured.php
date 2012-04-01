<?php
/**
 * The template used for displaying page content in preview loops
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("featured"); ?>>
	<header class="entry-header">
		<h3 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<? the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->