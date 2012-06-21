<?php

add_action('sfhiv_pre_loop','sfhiv_service_archive_draw_menu',5,2);
function sfhiv_service_archive_draw_menu($query=false,$args=array()){
	if(!$query || !in_array($query->query_vars['post_type'],array("sfhiv_service","sfhiv_service_hour"))) return;
	$new_query = sfhiv_remove_url_vars_from_query($query,array('sfhiv_service_category'));
	$tax_term_ids = sfhiv_get_term_ids_in_query($new_query);
	
	$base_url = preg_replace('/page\/(\d+)\//i','',$_SERVER[REQUEST_URI]); // strip out page var if in url
	if(isset($args['id']))	$base_url .= "#".$args['id'];
	
	echo '<section class="filters">';
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => 'All Services',
		'extra_classes' => 'filter additive',
		'base_link' => $base_url,
		'exclude_cats' => $tax_term_ids,
		'walker' => new SFHIV_Category_Walker_Filter(),
	));
	sfhiv_draw_taxonomy_query_menu('sfhiv_day_of_week_taxonomy',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => 'Any Day',
		'extra_classes' => 'filter',
		'base_link' => $base_url,
	));
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => "All Populations",
		'extra_classes' => 'filter population',
		'base_link' => $base_url,

	));
	echo '<i></i>';
	echo '</section>';
}

//add_action('sfhiv_pre_loop','sfhiv_service_archive_add_service_category_menu',5,2);
function sfhiv_service_archive_add_service_category_menu($query=false,$args=array()){
	if(!$query || !in_array($query->query_vars['post_type'],array("sfhiv_service","sfhiv_service_hour"))) return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => false,
		'extra_classes' => 'filters collapsable',
		'base_link' => $_SERVER['REQUEST_URI'],
	));
}

//add_action('sfhiv_pre_loop','sfhiv_service_archive_add_population_category_menu',6,2);
function sfhiv_service_archive_add_population_category_menu($query=false,$args=array()){
	if(!$query || !in_array($query->query_vars['post_type'],array("sfhiv_service","sfhiv_service_hour"))) return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => "All Populations",
		'extra_classes' => 'filters collapsable',
		'base_link' => $_SERVER['REQUEST_URI'],
	));
}

//add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_neighborhood_category_menu',9,2);
function sfhiv_service_hour_archive_neighborhood_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_neighborhood_category',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => 'Any Neighborhood',
		'extra_classes' => 'filters',
		'base_link' => $_SERVER['REQUEST_URI'],
	));
}

//add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_day_of_week_category_menu',9,2);
function sfhiv_service_hour_archive_day_of_week_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_day_of_week_taxonomy',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => 'Any Day',
		'extra_classes' => 'filters collapsable',
		'base_link' => $_SERVER['REQUEST_URI'],
	));
}

//add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_time_of_day_category_menu',9,2);
function sfhiv_service_hour_archive_time_of_day_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_time_of_day_taxonomy',$query,array(
		'title_li' => false,
		'all_taxonomy_name' => 'Any Time',
		'extra_classes' => 'filters',
		'base_link' => $_SERVER['REQUEST_URI'],
	));
}

?>