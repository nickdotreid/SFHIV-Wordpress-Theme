<?php get_header(); ?>
<div id="primary">
	<div id="content" role="main">
			<article id="archive" class="list">
				<header>
					<h1 class="entry-title"><?=$wp_query->queried_object->label;?></h1>
				</header>
				<? get_template_part("loop",$wp_query->query_vars['post_type']);	?>
		</article><!-- #archive -->
	</div><!-- #content -->
</div><!--	#primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>