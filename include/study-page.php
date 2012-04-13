<?php

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