<?php

require_once('utilities/query_mapper.php');
require_once('utilities/menu_wrapper.php');

add_action('get_sidebar','sfhiv_group_page_groups_by_year',20);
function sfhiv_group_page_groups_by_year(){
	global $wp_query;
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 0 ){
		sfhiv_draw_menu($query->posts);
	}
}

add_action('get_sidebar','sfhiv_group_page_group_by_years',21);
function sfhiv_group_page_group_by_years(){
	global $wp_query;
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_year'));
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year');
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_year',
		'title_li' => false,
		'include' => implode(",",$service_categories),
		'current_category' => $current_categories[0],
	));
}
?>