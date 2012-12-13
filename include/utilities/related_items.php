<?php

function sfhiv_get_related_in($query,$relation){
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;
	$related_objects = array();
	foreach($query->posts as $post){
		$post_relations = new WP_Query( array(
			'connected_type' => $relation,
			'connected_items' => $post->ID,
		));
		foreach($post_relations as $related){
			if(isset($related->ID)){
				if(!in_array($related,$related_objects)){
					array_push($related_objects,$related);
				}
			}
		}
	}
	return $related_objects;
}


function sfhiv_get_taxonomy_in($query,$taxonomy_name,$fields=false){
	$taxonomies = array();
	$args = array();
	if($fields){
		$args['fields'] = $fields;
	}
	foreach($query->posts as $post){
		$post_taxonomies = wp_get_object_terms($post->ID,$taxonomy_name,$args);
		foreach($post_taxonomies as $taxonomy){
			if(!in_array($taxonomy,$taxonomies)){
				array_push($taxonomies,$taxonomy);
			}
		}
	}
	if(!$fields){
		usort($taxonomies,function($a,$b){
			if($a->term_order > $b->term_order){
				return 1;
			}
			return 0;
		});
	}
	return $taxonomies;
}

?>