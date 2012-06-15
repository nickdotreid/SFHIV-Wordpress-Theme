<?php

function get_similar_to($post,$not_in_categories=array()){
	if(!is_array($not_in_categories)){
		$not_in_categories = array();
	}
	$tax_query = array(
		'relation' => 'and',
	);
	foreach(get_object_taxonomies($post->post_type) as $taxonomy){
		if(!in_array($taxonomy,$not_in_categories)){
			$tax_ids = wp_get_object_terms($post->ID,$taxonomy,array('fields'=>'ids'));
			if(count($tax_ids)>0){
				array_push($tax_query,array(
					'taxonomy' => $taxonomy,
					'field' => 'id',
					'terms' => $tax_ids,
				));
			}			
		}
	}
	$query = new WP_Query(array(
		'post_type' => $post->post_type,
		'tax_query' => $tax_query,
		'nopaging' => true,
	));
	return $query;
}

?>