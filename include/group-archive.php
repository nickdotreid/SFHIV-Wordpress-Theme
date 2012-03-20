<?php

add_action('get_sidebar','sfhiv_group_archive_filter_by_years',22);
function sfhiv_group_archive_filter_by_years(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_group') return;
	$args = array(
		'base_link' => get_post_type_archive_link( 'sfhiv_group' ),
		);
	if(is_page())
		$args['base_link'] = get_permalink();
	sfhiv_draw_taxonomy_query_menu(
		'sfhiv_year',
		sfhiv_remove_url_vars_from_query($query,array('sfhiv_year')),
		$args);
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
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_group') return;
	sfhiv_draw_taxonomy_query_menu(
		'sfhiv_group_category',
		sfhiv_remove_url_vars_from_query($query,array('sfhiv_group_category')),
		array(
		'base_link' => get_post_type_archive_link( 'sfhiv_group' ),
	));
}

?>