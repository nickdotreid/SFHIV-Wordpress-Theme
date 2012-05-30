<?php
/**
 * The template used for displaying page content in preview loops
 *
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class("featured slider-item"); ?>>
	<header class="entry-header">
		<h3 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<? the_excerpt(); ?>
	</div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->