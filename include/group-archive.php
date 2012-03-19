<?php

add_action('get_sidebar','sfhiv_groups_in_query_sidebar',25);
function sfhiv_groups_in_query_sidebar(){
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		// get wp_query
	}
	if(!$query): return; endif;
	$groups = sfhiv_get_related_in($query,'group_events');
	if(count($groups)>0){
		$query = new WP_Query( array( 'post__in' => $groups, 'post_type'=>'sfhiv_group' ) );
		if($query->post_count > 0):
			?><nav><ul class="menu groups filters"><?
			if($query->post_count > 1){
				?><li class="" slug=""><a href="" slug="">All Groups</a></li><?
			}
			while($query->have_posts()):
				$query->the_post();
				get_template_part('menu-item','sfhiv_group');
			endwhile;
			?></ul></nav><?
		endif;
		wp_reset_postdata();				
	}
}

add_action('get_sidebar','sfhiv_add_query_group_cat_sidebar',21);
function sfhiv_add_query_group_cat_sidebar(){
	global $wp_query;
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		// get wp_query
		$wp_query->rewind_posts();
		$query = $wp_query;
	}
	if(!$query): return; endif;
	$groups = sfhiv_get_taxonomy_in($query,'sfhiv_group_category','ids');
	if(count($groups)>1):
	sfhiv_draw_taxonomy_filter(array(
		'taxonomy' => 'sfhiv_group_category',
		'include' => implode(",",$groups),
		'title_li' => false,
	));
	endif;
}

?>