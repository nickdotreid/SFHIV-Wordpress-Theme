<?php

add_action('sfhiv_pre_loop','sfhiv_event_filter',10,2);
function sfhiv_event_filter($query=false,$args){
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_event') return;
	sfhiv_draw_filters('sfhiv_event_time',array(
		array(
			"value" => "upcoming",
			"name" => "Upcoming"
		),
		array(
			"value" => "past",
			"name" => "Past"
		)
	));
}

?>