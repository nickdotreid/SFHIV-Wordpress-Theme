<?php

add_action('get_sidebar','sfhiv_report_archive_year_category_menu',22);
function sfhiv_report_archive_year_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_report') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_year',$query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_report' ),
	));
}

add_action('get_sidebar','sfhiv_report_archive_report_category_menu',21);
function sfhiv_report_archive_report_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_report') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_report_category',$query);
}

?>