<?php

add_filter('the_permalink','sfhiv_service_hour_change_permalink',1);
function sfhiv_service_hour_change_permalink($link){
	if(get_post_type() != 'sfhiv_service_hour') return $link;
	$parent = sfhiv_service_hour_get_parent(get_post(get_the_ID()));
	if($parent){
		return get_permalink($parent->ID);
	}
	return $link;
}

add_action('short_navigation','sfhiv_service_hour_show_edit_link',1);
function sfhiv_service_hour_show_edit_link(){
	if(get_post_type() != 'sfhiv_service_hour') return;
	$service = sfhiv_service_hour_get_parent(get_post());
	if(!$service) return;
	edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>', $service->ID );
}

add_action('after_list-item','sfhiv_service_hour_display_day',7);
add_action('short_before_content','sfhiv_service_hour_display_day',7);
function sfhiv_service_hour_display_day(){
	if (get_post_type()!='sfhiv_service_hour') return;
	$days = sfhiv_service_get_service_days(get_post(get_the_ID()));
	echo '<div class="date">';
	foreach($days as $day){
		$term = get_term_by('slug',$day,'sfhiv_day_of_week_taxonomy');
		echo '<span class="day">'.$term->name.'</span>';
	}
	echo '</div>';
}

add_action('after_list-item','sfhiv_service_hour_display_time',8);
add_action('short_before_content','sfhiv_service_hour_display_time',8);
function sfhiv_service_hour_display_time(){
	if (get_post_type()!='sfhiv_service_hour') return;
	$post = get_post(get_the_ID());
	$start = sfhiv_service_get_start_time($post);
	$end = sfhiv_service_get_end_time($post);
	
	$time_format = get_option('time_format');
	
	echo '<div class="time">';
	echo '<span class="start">'.date($time_format,$start).'</span>';
	if($start != $end){
		echo '<span class="">until </span>';
		echo '<span class="end">'.date($time_format,$end).'</span>';		
	}
	echo '</div>';
}

add_action('short_before_content','sfhiv_display_location',10);
add_action('after_list-item','sfhiv_display_location',10);

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
	if( get_post_type() != 'sfhiv_service' ) return;
	$service_hours = new WP_Query( array(
		'post_type' => 'sfhiv_service_hour',
		'connected_type' => 'service_time',
		'connected_items' => get_the_ID(),
	));
	do_action('sfhiv_loop',$service_hours,array(
		"id" => "service_times",
		"title" => "When and Where",
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