<?php

add_action('sfhiv_pre_loop','sfhiv_group_archive_filter_by_years',22,2);
function sfhiv_group_archive_filter_by_years($query,$args){
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_group') return;
	
	$base_url = preg_replace('/page\/(\d+)\//i','',$_SERVER['REQUEST_URI']); // strip out page var if in url
	if(isset($args['id']))	$base_url .= "#".$args['id'];
	
	sfhiv_draw_taxonomy_query_menu('sfhiv_year',$query,array(
		'title_li' => false,
		'extra_classes' => 'filter filter-horizontal',
		'base_link' => $base_url,
	));
}

?>