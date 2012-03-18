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

?>