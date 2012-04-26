<?php

add_action('get_sidebar','sfhiv_service_archive_add_service_category_menu',21);
function sfhiv_service_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query);
}

add_action('get_sidebar','sfhiv_service_archive_add_population_category_menu',21);
function sfhiv_service_archive_add_population_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query);
}


//add_action('get_sidebar','sfhiv_service_hour_archive_add_service_category_menu',21);
function sfhiv_service_hour_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query);
}

add_action('get_sidebar','sfhiv_service_hour_archive_population_category_menu',22,2);
function sfhiv_service_hour_archive_population_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query,array(
		'title_li' => 'Population Specific',
		'base_link' => get_permalink(),
	));
}

add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_neighborhood_category_menu',9,2);
function sfhiv_service_hour_archive_neighborhood_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_neighborhood_category',$query,array(
		'title_li' => 'Neighborhood',
		'extra_classes' => 'filters',
		'base_link' => get_permalink(),
	));
}

add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_day_of_week_category_menu',9,2);
function sfhiv_service_hour_archive_day_of_week_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_day_of_week_taxonomy',$query,array(
		'title_li' => 'Day of Week',
		'extra_classes' => 'filters',
		'base_link' => get_permalink(),
	));
}

add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_time_of_day_category_menu',9,2);
function sfhiv_service_hour_archive_time_of_day_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_time_of_day_taxonomy',$query,array(
		'title_li' => 'Time of Day',
		'extra_classes' => 'filters',
		'base_link' => get_permalink(),
	));
}

add_filter('sfhiv_loop_filter_query','sfhiv_service_hour_archive_sort',20);
function sfhiv_service_hour_archive_sort($query){
	usort($query->posts,function($a,$b){
		$day_terms = get_terms( "sfhiv_day_of_week_taxonomy", array(
			"hide_empty" => false,
			));
		foreach($day_terms as $term){
			if(has_term($term,'sfhiv_day_of_week_taxonomy',$a) && has_term($term,'sfhiv_day_of_week_taxonomy',$b)){
				if(sfhiv_service_get_start_time($a) > sfhiv_service_get_start_time($b)){
					return 1;
				}else{
					return -1;
				}
			}
			if(has_term($term,'sfhiv_day_of_week_taxonomy',$a)){
				return -1;
			}
			if(has_term($term,'sfhiv_day_of_week_taxonomy',$b)){
				return 1;
			}
		}
		return 0;
	});
	return $query;
}

?>