<?php get_header(); ?>
<div id="primary">
	<div id="content" role="main">
			<article id="archive" class="list">
				<header>
					<h1 class="entry-title">
					<?
					$obj = get_post_type_object($wp_query->query['post_type']);
					print $obj->label;
					?>
					</h1>
				</header>
				<? do_action("sfhiv_loop",$wp_query);	?>
		</article><!-- #archive -->
	</div><!-- #content -->
</div><!--	#primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>