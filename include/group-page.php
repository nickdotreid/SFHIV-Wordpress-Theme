<?php

require_once('utilities/query_mapper.php');

add_action('get_sidebar','sfhiv_group_page_groups_by_year',20);
function sfhiv_group_page_groups_by_year(){
	global $wp_query;
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 0 ){
		$orginal_query = $wp_query;
		$wp_query = $query;
		get_template_part('menu',get_post_type());
		$wp_query = $orginal_query;
		wp_reset_postdata();
	}
}

add_action('get_sidebar','sfhiv_group_page_group_by_years',21);
function sfhiv_group_page_group_by_years(){
	global $wp_query;
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_year'));
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year');
	?>
	<nav><ul class="menu">
	<?
	$current_categories =  wp_get_object_terms(get_the_ID(),'sfhiv_year',array('fields'=>'ids'));
	wp_list_categories(array(
		'taxonomy' => 'sfhiv_year',
		'title_li' => false,
		'include' => implode(",",$service_categories),
		'current_category' => $current_categories[0],
	));
	?></ul></nav><?
}
?>