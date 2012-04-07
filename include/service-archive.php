<?php

include_once('service-category-functions.php');
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


add_action('get_sidebar','sfhiv_service_hour_archive_add_service_category_menu',21);
function sfhiv_service_hour_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query);
}

add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_population_category_menu',9,2);
function sfhiv_service_hour_archive_population_category_menu($query=false,$args=array()){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query,array(
		'title_li' => 'Population',
		'extra_classes' => 'filters',
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

add_action('sfhiv_pre_loop','sfhiv_service_hour_archive_filter_container',10,2);
function sfhiv_service_hour_archive_filter_container($query=false,$args=array()){
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	echo '<div class="filters">';
	do_action('sfhiv_service_hour_get_filters',$query,$args);
	echo '</div>';
}


$sfhiv_time_options = array(
	array(
		"value" => 'morning',
		"name" => 'Morning',
		"start" => "6AM",
		"end" => "11AM"
	),
	array(
		"value" => 'afternoon',
		"name" => 'Afternoon',
		"start" => "11AM",
		"end" => "6PM"
	),
	array(
		"value" => 'night',
		"name" => 'Night',
		"start" => "6pm",
		"end" => "11:59PM"
	),
);

$sfhiv_service_hour_days = array(
	array(
		"value" => 'monday',
		"name" => 'Monday'
	),
	array(
		"value" => 'tuesday',
		"name" => 'Tuesday'
	),
	array(
		"value" => 'wednesday',
		"name" => 'Wednesday'
	),
	array(
		"value" => 'thursday',
		"name" => 'Thursday'
	),
	array(
		"value" => 'friday',
		"name" => 'Friday'
	),
	array(
		"value" => 'saturday',
		"name" => 'Saturday'
	),
	array(
		"value" => 'sunday',
		"name" => 'Sunday'
	),
);

add_action('sfhiv_service_hour_get_filters','sfhiv_service_hours_archive_select_day',11,2);
function sfhiv_service_hours_archive_select_day($query=false,$args){
	global $sfhiv_service_hour_days;
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	if(is_singular('sfhiv_service')) return;
	sfhiv_draw_filters('sfhiv_service_hour_day',$sfhiv_service_hour_days,'Any Day');
}

add_action( 'pre_get_posts', 'sfhiv_service_hour_archive_alter_query_day' );
function sfhiv_service_hour_archive_alter_query_day( $query ) {
    global $sfhiv_service_hour_days;
	
	if(is_admin() || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	if(isset($_GET['sfhiv_service_hour_day'])){
		foreach($sfhiv_service_hour_days as $option){
			if($_GET['sfhiv_service_hour_day'] == $option['value']){
				if(!isset($query->query_vars['meta_query']) || !is_array($query->query_vars['meta_query'])){
					$query->query_vars['meta_query'] = array();
				}
				array_push($query->query_vars['meta_query'],array(
					'key' => 'sfhiv_service_days',
					'value' => $option['value'],
				));
			}
		}
	}
}

add_action('sfhiv_service_hour_get_filters','sfhiv_service_hours_archive_select_time',10,2);
function sfhiv_service_hours_archive_select_time($query=false,$args){
	global $sfhiv_time_options;
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	if(is_singular('sfhiv_service')) return;
	sfhiv_draw_filters('sfhiv_service_hour_time',$sfhiv_time_options,'Any Time');
}

add_action( 'pre_get_posts', 'sfhiv_service_hour_archive_alter_query_time' );
function sfhiv_service_hour_archive_alter_query_time( $query ) {
    global $sfhiv_time_options;
	
	if(is_admin() || $query->query_vars['post_type'] != 'sfhiv_service_hour') return;
	if(isset($_GET['sfhiv_service_hour_time'])){
		foreach($sfhiv_time_options as $option){
			if($_GET['sfhiv_service_hour_time'] == $option['value']){
				$my_query = array();
				$my_query['relation'] = 'OR';
				array_push($my_query,array(
					'key' => 'sfhiv_service_start',
					'value' => array(
						sfhiv_service_hours_string_to_time($option['start']),
						sfhiv_service_hours_string_to_time($option['end'])
						),
					'type' => 'numeric',
					'compare' => 'BETWEEN'
				));
				array_push($my_query,array(
					'key' => 'sfhiv_service_end',
					'value' => array(
						sfhiv_service_hours_string_to_time($option['start']),
						sfhiv_service_hours_string_to_time($option['end'])
						),
					'type' => 'numeric',
					'compare' => 'BETWEEN'
				));
				if(!isset($query->query_vars['meta_query']) || !is_array($query->query_vars['meta_query'])){
					$query->query_vars['meta_query'] = array();
				}
				array_push($query->query_vars['meta_query'],$my_query);
			}
		}
	}
}




?>