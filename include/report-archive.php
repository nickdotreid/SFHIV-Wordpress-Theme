<?php

add_action('get_sidebar','sfhiv_report_archive_filter_by_years',22);
function sfhiv_report_archive_filter_by_years(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_report') return;
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(count($years)<2) return;
	$base_link = get_post_type_archive_link( 'sfhiv_report' );
	if(is_page()){
		$base_link = get_permalink();
	}
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_year',
		'include' => implode(",",$years),
		'title_li' => false,
		'base_link' =>  $base_link,
	));
}

add_action('get_sidebar','sfhiv_report_archive_filter_by_report_category',21);
function sfhiv_report_archive_filter_by_report_category(){
	$query = sfhiv_get_archive_query();
	if(!$query) return;
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_report_category','ids');
	if(count($categories)<2) return;
	$base_link = get_post_type_archive_link( 'sfhiv_report' );
	if(is_page()){
		$base_link = get_permalink();
	}
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_report_category',
		'include' => implode(",",$categories),
		'title_li' => false,
		'base_link' =>  $base_link,
	));
}

?>