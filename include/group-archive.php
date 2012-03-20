<?php
include_once('years_archive.php');

add_action('get_sidebar','sfhiv_group_archive_filter_by_years',22);
function sfhiv_group_archive_filter_by_years(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_group') return;
	sfhiv_draw_years_category_sidebar($query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_group' ),
	));
}

add_action('get_sidebar','sfhiv_groups_in_query_sidebar',25);
function sfhiv_groups_in_query_sidebar(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] == 'sfhiv_group'): return; endif;
	$groups = sfhiv_get_related_in($query,'group_events');
	if(count($groups)<2) return;
	sfhiv_draw_menu($groups);
}

add_action('get_sidebar','sfhiv_add_query_group_cat_sidebar',21);
function sfhiv_add_query_group_cat_sidebar(){
	$query = sfhiv_get_archive_query();
	if(!$query): return; endif;
	sfhiv_draw_group_category_sidebar($query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_group' ),
	));
}

function sfhiv_draw_group_category_sidebar($query,$args = array()){
	// make sure query post_type is related to sfhiv_year
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_group_category','ids');
	if(!isset($args['min_display'])) $args['min_display'] = 2;
	if(count($categories) < $args['min_display']) return;
	$args = array_merge(array(
		'taxonomy' => 'sfhiv_group_category',
		'include' => implode(",",$categories),
		'title_li' => 'Group Categories',
	),$args);
	if(!isset($args['base_link']) && is_page()){
		$args['base_link'] = get_permalink();
	}
	sfhiv_draw_taxonomy_menu($args);
}

?>