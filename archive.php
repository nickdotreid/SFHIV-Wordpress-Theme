<?php get_header(); ?>
<div id="primary">
	<div id="content" role="main">
			<article id="archive">
				<header>
					<h1 class="entry-title"><?=$wp_query->queried_object->label;?></h1>
				</header>
				<? get_template_part("loop");	?>
		</article><!-- #archive -->
	</div><!-- #content -->
</div><!--	#primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>