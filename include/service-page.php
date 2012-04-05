<?php

add_action('get_sidebar','sfhiv_service_page_service_type',21);
function sfhiv_service_page_service_type(){
	if (!is_singular('sfhiv_service')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_service_category'));
	$service_categories = sfhiv_get_taxonomy_in($query,'sfhiv_service_category','ids');
	if(count($service_categories)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_service_category',
		'include' => implode(",",$service_categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_service' ),
		'title_li' => 'Services',
	));
}

add_action('get_sidebar','sfhiv_service_page_population_categories',21);
function sfhiv_service_page_population_categories(){
	if (!is_singular('sfhiv_service')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_population_category'));
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_population_category','ids');
	if(count($categories)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_population_category',
		'include' => implode(",",$categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_service' ),
		'title_li' => 'Populations',
	));
}

add_action('get_sidebar','sfhiv_service_page_parent_groups',20);
function sfhiv_service_page_parent_groups(){
	if (!is_singular('sfhiv_service')) return;
	$groups = sfhiv_service_get_groups(get_the_ID());
	if(count($groups)<1) return;
	$group_ids = array();
	foreach($groups as $group){
		$group_ids[] = $group->ID;
	}
	sfhiv_draw_menu($groups,array(
		'selected_items' => $group_ids,
	));
}

add_action('get_footer','sfhiv_service_page_service_hours',20);
function sfhiv_service_page_service_hours(){
	if (!is_singular('sfhiv_service')) return;
	$service_hours = new WP_Query( array(
		'post_type' => 'sfhiv_service_hour',
		'connected_type' => 'service_time',
		'connected_items' => get_the_ID(),
	));
	do_action('sfhiv_loop',$service_hours,array(
		"id" => "service_times",
		"title" => "Time & Location",
		"list_element" => "list-item",
	));
}

function sfhiv_service_get_groups($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$groups = new WP_Query( array(
		'connected_type' => 'group_services',
		'connected_items' => $ID,
	));
	return $groups->posts;
}

?>