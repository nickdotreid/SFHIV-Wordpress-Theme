<?php

add_action('sfhiv_loop_arguments','sfhiv_event_archive_loop_arguments',10,2);
function sfhiv_event_archive_loop_arguments($args,$post_type){
	if($post_type != 'sfhiv_event') return $args;
	$args['show_empty'] = true;
	return $args;
}

add_action('sfhiv_pre_loop','sfhiv_event_filter',10,2);
function sfhiv_event_filter($query=false,$args){
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_event') return;
	sfhiv_draw_filters('sfhiv_event_time',array(
		array(
			"value" => "upcoming",
			"name" => "Upcoming",
			'default' => true,
		),
		array(
			"value" => "past",
			"name" => "Past"
		)
	));
}

add_action('get_sidebar','sfhiv_event_archive_event_categories',22);
function sfhiv_event_archive_event_categories(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_event') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_event_category',$query);
}

?>