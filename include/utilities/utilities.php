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
	return $query;
}

?>