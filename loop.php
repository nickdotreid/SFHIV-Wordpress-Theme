<?php if ( have_posts() ) : ?>

	<?php toolbox_content_nav( 'nav-above' ); ?>
	
	<?	while($wp_query->have_posts()):	$wp_query->the_post();?>
	
	<?	get_template_part( 'list', $wp_query->query_vars['post_type'] );	?>
	
	<?	endwhile;	?>

	<?php toolbox_content_nav( 'nav-below' ); ?>

<?php else : ?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'sfhiv_theme' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sfhiv_theme' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; ?>