<?php if ( have_posts() ) :
	toolbox_content_nav( 'nav-above' );
	
	$printed = array();
	$years = sfhiv_get_taxonomy_in($wp_query,'sfhiv_year');
	if(count($years) > 1):
		foreach($years as $year):
			?><h2 class="year list-heading" year-slug="<?=$year->slug;?>"><?=$year->name;?></h2><?
			while($wp_query->have_posts()):	$wp_query->the_post();
				$post_terms = wp_get_post_terms($post->ID, 'sfhiv_year', array("fields" => "ids"));
				if(in_array($year->term_id,$post_terms) && !in_array($post->ID,$printed)):
					array_push($printed,$post->ID);
					get_template_part( 'list', $wp_query->query_vars['post_type'] );
				endif;
			endwhile;
			$wp_query->rewind_posts();
		endforeach;
	endif;
	while($wp_query->have_posts()):	$wp_query->the_post();
		if(!in_array($post->ID,$printed)):
			get_template_part( 'list', $wp_query->query_vars['post_type'] );
		endif;
	endwhile;

	toolbox_content_nav( 'nav-below' );
endif; ?>