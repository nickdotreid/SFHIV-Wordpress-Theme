<?php

include_once('menu_wrapper.php');
include_once('related_items.php');
include_once('query_mapper.php');

include_once('walker_category_menu.php');
include_once('walker_category_filter.php');

function sfhiv_get_archive_query(){
	global $wp_query;
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		$wp_query->rewind_posts();
		$query = $wp_query;
	}
	return sfhiv_remove_url_vars_from_query($query);
}

function sfhiv_remove_url_vars_from_query($query){
	$replace = false;
	$new_args = $query->query_vars;
	$new_args['tax_query'] = array(
		'relation' => $query->query_vars['tax_query']['relation'],
	);
	$url_keys = array_keys($_GET);
	
	foreach($query->query_vars['tax_query'] as $tax_query){
		if(in_array($tax_query['taxonomy'],$url_keys) &&
			($tax_query['terms'] == $_GET[$tax_query['taxonomy']])){
			$replace = true;
		}else{
			array_push($new_args,$tax_query);
		}
	}
	
	if($replace){
		return new WP_Query($new_args);
	}
	return $query;
}

?>