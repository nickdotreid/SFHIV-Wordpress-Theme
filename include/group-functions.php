<?php

add_action('wp_head','sfhiv_groups_add_scripts',16);
function sfhiv_groups_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/groups.js"></script>
	<?
}

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

function sfhiv_group_has_members($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$users = get_users( array(
	  'connected_type' => 'group_members',
	  'connected_items' => get_the_ID(),
		'orderby' => 'display_name',
	));
	if(count($users)>0){
		return true;
	}
	return false;
}

function sfhiv_group_get_members($ID = false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$users = get_users( array(
	  'connected_type' => 'group_members',
	  'connected_items' => get_the_ID(),
		'orderby' => 'display_name',
	));
	if(count($users)<1) return array();
	usort($users,function($a,$b){
		$a_title = p2p_get_meta( $a->p2p_id, 'title', true );
		$b_title = p2p_get_meta( $b->p2p_id, 'title', true );
		if($a_title && $b_title){
			if($a_title < $b_title){
				return -1;
			}else{
				return 1;
			}
		}
		if($a_title){
			return -1;
		}
		if($b_title){
			return 1;
		}
		$a_order = p2p_get_meta( $a->p2p_id, 'order', true );
		$b_order = p2p_get_meta( $b->p2p_id, 'order', true );
		if($a_order && $b_order){
			if($a_order < $b_order){
				return -1;
			}else{
				return 1;
			}
		}
		if($a_order){
			return -1;
		}
		if($b_order){
			return 1;
		}
		return 0;
	});
	return $users;
}

add_action('get_footer','sfhiv_add_group_members_list',5);
function sfhiv_add_group_members_list(){
	if(!is_singular( array( 'sfhiv_group' ))):
		return true;
	endif;
	$users = get_users( array(
		'connected_type' => 'group_members',
		'connected_items' => get_the_ID(),
		'orderby' => 'display_name',
		'nopaging' => true,
	));
	if(count($users)>0):
		usort($users,function($a,$b){
			$a_order = p2p_get_meta( $a->p2p_id, 'order', true );
			$b_order = p2p_get_meta( $b->p2p_id, 'order', true );
			if($a_order && $b_order){
				if($a_order < $b_order){
					return -1;
				}else{
					return 1;
				}
			}
			if($a_order){
				return -1;
			}
			if($b_order){
				return 1;
			}
			return 0;
		});
	endif;
}

function sfhiv_group_has_events($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$events = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
	));
	if($events->have_posts()){
		return true;
	}
	return false;
}

function sfhiv_group_get_events($id=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$events = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
		'nopaging' => true,
	));
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

?>