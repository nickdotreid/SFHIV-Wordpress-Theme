<?php

include_once('menu_wrapper.php');
include_once('related_items.php');
include_once('query_mapper.php');

include_once('filters.php');

include_once('walker_category_menu.php');
include_once('walker_category_filter.php');

include_once('walker_page_menu.php');

function sfhiv_append_url_argument($url,$key,$value){
	return add_query_arg($key,$value,$url);
}


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

function sfhiv_get_term_ids_in_query($query){
	$tax_query = $query->query_vars['tax_query'];
	$terms = array();
	foreach($tax_query as $tax_q){
		if(is_array($tax_q)){
			$tax_terms = explode(",",$tax_q['terms']);
			foreach($tax_terms as $t_value){
				if($tax_q != "id"){
					$term_obj = get_term_by($tax_q['field'],$t_value,$tax_q['taxonomy']);
					if($term_obj){
						array_push($terms,$term_obj->term_id);
					}
				}else{
					array_push($terms,$t_value);
				}
			}
		}
	}
	return $terms;
}

function sfhiv_remove_url_vars_from_query($query,$include_only_keys=array()){
	$url_keys = $_GET;
	foreach($url_keys as $key => $value){
		if(!in_array($key,$include_only_keys)){
			unset($url_keys[$key]);
		}
	}
	foreach($url_keys as $key=>$value){
		$url_keys[$key] = explode(",",$value);
	}
	return sfhiv_remove_keys_from_query($query,$url_keys);
}

function sfhiv_remove_keys_from_query($query,$keys = array()){
	$replace = false;
	$new_args = $query->query_vars;
	
	foreach($keys as $key => $value){
		if(isset($new_args[$key]) &&
			(in_array($new_args[$key],$value) || $value == -1)){
			$replace = true;
			unset($new_args[$key]);
		}
		if($new_args['taxonomy']==$key && 
			(in_array($new_args['term'],$value) || $value == -1)){
			$replace = true;
			unset($new_args['taxonomy']);
			unset($new_args['term']);
		}
	}
	foreach($new_args['tax_query'] as $index => $tax_query){
		if( is_array($tax_query) && in_array($tax_query['taxonomy'],array_keys($keys))){
			if(in_array($tax_query['terms'],$keys[$tax_query['taxonomy']]) || $keys[$tax_query['taxonomy']] == -1){
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

function sfhiv_unpage_query($query){
	if($query->max_num_pages<2)	return $query;
	$new_args = $query->query_vars;
	$new_args['nopaging'] = true;
	return new WP_Query($new_args);
}

?>