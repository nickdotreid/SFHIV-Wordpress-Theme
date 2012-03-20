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

function sfhiv_remove_url_vars_from_query($query,$include_only_keys=array()){
	$url_keys = $_GET;
	foreach($url_keys as $key => $value){
		if(!in_array($key,$include_only_keys)){
			unset($url_keys[$key]);
		}
	}
	return sfhiv_remove_keys_from_query($query,$url_keys);
}

function sfhiv_remove_keys_from_query($query,$keys = array()){
	$replace = false;
	$new_args = $query->query_vars;
	
	foreach($keys as $key => $value){
		if(isset($new_args[$key]) &&
			($new_args[$key] == $value || $value == -1)){
			$replace = true;
			unset($new_args[$key]);
			
		}
		if($new_args['taxonomy']==$key && 
			($new_args['term']==$value || $value == -1)){
			$replace = true;
			unset($new_args['taxonomy']);
			unset($new_args['term']);
		}
	}
	
	foreach($new_args['tax_query'] as $index => $tax_query){
		if( $index!='relation' && in_array($tax_query['taxonomy'],array_keys($keys))){
			if($tax_query['terms'] == $keys[$tax_query['taxonomy']] || $keys[$tax_query['taxonomy']] == -1){
				$replace = true;
				unset($new_args['tax_query'][$index]);
			}
		}
	}
	
	if($replace){
		return new WP_Query($new_args);
	}
	return $query;
}

?>