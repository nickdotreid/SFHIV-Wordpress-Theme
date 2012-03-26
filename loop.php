<?php if ( have_posts() ) : ?>
	
	<?php toolbox_content_nav( 'nav-above' ); ?>
	
	<?	while($wp_query->have_posts()):	$wp_query->the_post();?>
	
	<?	get_template_part( 'list', $wp_query->query_vars['post_type'] );	?>
	
	<?	endwhile;	?>

	<?php toolbox_content_nav( 'nav-below' ); ?>
	
<?php endif; ?>