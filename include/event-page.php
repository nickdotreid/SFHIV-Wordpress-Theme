<?php

add_action('before_list-item','sfhiv_event_page_show_date',5);
add_action('short_before_content','sfhiv_event_page_show_date',5);
add_action('before_content','sfhiv_event_page_show_date',5);
function sfhiv_event_page_show_date(){
	if(get_post_type() != 'sfhiv_event') return;
	get_template_part('date','event');
}

add_action('short_before_content','sfhiv_event_page_show_time',5);
add_action('before_content','sfhiv_event_page_show_time',5);
function sfhiv_event_page_show_time(){
	if(get_post_type() != 'sfhiv_event') return;
	get_template_part('time','event');
}

add_action('before_content','sfhiv_event_display_location',7);
add_action('short_before_content','sfhiv_event_display_location',10);
function sfhiv_event_display_location(){
	if(get_post_type() != 'sfhiv_event') return;
	sfhiv_display_location();
}

add_action('get_sidebar','sfhiv_event_page_parent_groups',22);
function sfhiv_event_page_parent_groups(){
	if (!is_singular('sfhiv_event')) return;
	$groups = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
	));
	if($groups->post_count<1) return;
	$group_ids = array();
	foreach($groups->posts as $group){
		$group_ids[] = $group->ID;
	}
	sfhiv_draw_menu($groups->posts,array(
		'selected_items' => $group_ids,
	));
}

?>