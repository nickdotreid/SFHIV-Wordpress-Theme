<?php

add_action('after_list-item','sfhiv_event_page_show_date_time',5);
add_action('short_before_content','sfhiv_event_page_show_date_time',5);
add_action('before_content','sfhiv_event_page_show_date_time',5);
function sfhiv_event_page_show_date_time(){
	if(get_post_type() != 'sfhiv_event') return;
	echo '<div class="date-time">';
	get_template_part('date','event');
	get_template_part('time','event');
	echo '</div>';
}

add_action('before_content','sfhiv_event_display_location',7);
add_action('short_before_content','sfhiv_event_display_location',10);
function sfhiv_event_display_location(){
	if(get_post_type() != 'sfhiv_event') return;
	$location = sfhiv_location_get_related_location(get_the_ID());
	if($location){
		sfhiv_location_format($location);
	}else{ ?>
	<div class="address address-tba">
		<i></i>
		<span>Location To Be Announced</span>
	</div>
	<?}
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