<?php

function sfhiv_group_menu_items($ID = false){
	if(!$ID && get_post_type() == 'sfhiv_group'){
		$ID = get_the_ID();
	}
	if(!$ID){
		return array();
	}
	$items = array();
	$members = get_users( array(
	  'connected_type' => 'group_members',
	  'connected_items' => $ID,
	));
	if(count($members)>0){
		array_push($items,"members");
	}
	$events = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => $ID,
	));
	if(count($events->posts)>0){
		array_push($items,"events");
	}
	$services = new WP_Query( array(
		'connected_type' => 'group_services',
		'connected_items' => $ID,
	));
	if(count($services->posts)>0){
		array_push($items,"services");
	}
	
	return $items;
}

function sfhiv_group_has_events($ID=false,$args=array()){
	if(!$ID){
		$ID = get_the_ID();
	}
	$events = sfhiv_group_get_events($ID,$args);
	if($events->have_posts()){
		return true;
	}
	return false;
}

function sfhiv_group_get_events($ID=false,$args=array()){
	if(!$ID){
		$ID = get_the_ID();
	}
	$events = new WP_Query( array_merge(array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
		'nopaging' => true,
		'post_type' => 'sfhiv_event',
		'sfhiv_event_selection' => 'all',
	),$args));
	return $events;
}

function sfhiv_group_has_services($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$services = new WP_Query( array(
		'connected_type' => 'group_services',
		'connected_items' => get_the_ID(),
	));
	if($services->have_posts()){
		return true;
	}
	return false;
}

function sfhiv_group_get_services($id=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$services = new WP_Query( array(
		'connected_type' => 'group_services',
		'connected_items' => get_the_ID(),
		'nopaging' => true,
	));
	return $services;
}

function sfhiv_group_has_studies($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$services = new WP_Query( array(
		'connected_type' => 'sfhiv_group_study',
		'connected_items' => get_the_ID(),
	));
	if($services->have_posts()){
		return true;
	}
	return false;
}

function sfhiv_group_get_studies($id=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$services = new WP_Query( array(
		'post_type' => 'sfhiv_study',
		'connected_type' => 'sfhiv_group_study',
		'connected_items' => get_the_ID(),
		'nopaging' => true,
	));
	return $services;
}

?>