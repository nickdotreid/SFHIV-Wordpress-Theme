<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?	if(!is_front_page()):	?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<? do_action('after_header');	?>
		<div class="clear"></div>
	</header><!-- .entry-header -->
	<?	endif;	?>
	<? do_action('before_content');	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<? do_action('after_content');	?>
	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->