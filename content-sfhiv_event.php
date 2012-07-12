<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<? do_action('before_content');	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<? do_action('after_content');	?>
	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->