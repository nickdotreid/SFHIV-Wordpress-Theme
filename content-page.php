<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?	if(!is_front_page()):	?>
	<header class="entry-header entry-header-full">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<? do_action('after_content_header');	?>
		<div class="clear"></div>
	</header><!-- .entry-header -->
	<?	endif;	?>
	<? do_action('before_content');	?>
	<div class="entry-content">
		<?	if(is_front_page()):	?>
		<div id="homepage-slider" class="carousel">
			<div class="carousel-inner">
			<?	dynamic_sidebar("Home Page Slider");	?>
			</div>
			<a class="carousel-control left" href="#homepage-slider" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#homepage-slider" data-slide="next">&rsaquo;</a>
		</div>
		<?	endif;	?>
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<? do_action('after_content');	?>
	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->