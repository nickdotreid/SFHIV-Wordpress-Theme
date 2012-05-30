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

//add_action('get_sidebar','sfhiv_study_navigation',22);
function sfhiv_study_navigation(){
	if (!is_singular('sfhiv_study')) return;
	sfhiv_draw_menu(array(get_post(get_the_ID())),array(
		'show_children' => true,
		'show_siblings' => true,
		'show_parents' => true,
	));
}

add_action('get_footer','sfhiv_study_list_children',20);
function sfhiv_study_list_children(){
	if (!is_singular('sfhiv_study')) return;
	$children = new WP_Query( array(
		'post_type' => 'sfhiv_study',
		'post_parent' => get_the_ID(),
	));
	do_action('sfhiv_loop',$children,array(
		"id" => "children",
		"title" => "Related Studies",
	));
}

add_action('get_footer','sfhiv_study_add_reports',22);
function sfhiv_study_add_reports(){
	if (!is_singular('sfhiv_study')) return;
	$reports = new WP_Query( array(
		'post_type' => 'sfhiv_document',
		'connected_type' => 'sfhiv_study_document',
		'connected_items' => get_the_ID(),
		'nopaging' => true,
	));
	do_action('sfhiv_loop',$reports,array(
		"id" => "reports",
		"title" => "Publications",
		"list_element" => 'short',
		'show_filters' => false,
		"wrap_before" => '<section>',
		"wrap_after" => '</section>',
	));
}
?>