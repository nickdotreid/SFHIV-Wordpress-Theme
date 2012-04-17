<?php

add_action('get_sidebar','sfhiv_study_add_groups',25);
function sfhiv_study_add_groups(){
	if (!is_singular('sfhiv_study')) return;
	$groups = new WP_Query( array(
		'connected_type' => 'sfhiv_group_study',
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

add_action('get_footer','sfhiv_study_add_reports',22);
function sfhiv_study_add_reports(){
	if (!is_singular('sfhiv_study')) return;
	$reports = new WP_Query( array(
		'post_type' => 'sfhiv_report',
		'connected_type' => 'sfhiv_study_report',
		'connected_items' => get_the_ID(),
	));
	do_action('sfhiv_loop',$reports,array(
		"id" => "reports",
		"title" => "Reports",
	));
}
?>