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

add_action('get_footer','sfhiv_add_group_members_list',5);
function sfhiv_add_group_members_list(){
	if(!is_singular( array( 'sfhiv_group' ))):
		return true;
	endif;
	$users = get_users( array(
	  'connected_type' => 'group_members',
	  'connected_items' => get_the_ID(),
		'orderby' => 'display_name',
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
	?>
	<aside id="members" class="list">
		<h2>Members</h2>
		<?
		$printed = array();
		foreach($users as $user):
			if(p2p_get_meta( $user->p2p_id, 'title', true ) && !p2p_get_meta( $user->p2p_id, 'incomplete', true ) && !in_array($user->ID,$printed)):
				array_push($printed,$user->ID);
				include(locate_template('list-member.php'));
			endif;
		endforeach;
		foreach($users as $user):
			if(!p2p_get_meta( $user->p2p_id, 'incomplete', true ) && !in_array($user->ID,$printed)):
				array_push($printed,$user->ID);
				include(locate_template('list-member.php'));
			endif;
		endforeach;
		?><h3>Members unable to complete term.</h3><?
		foreach($users as $user):
			if(!in_array($user->ID,$printed)):
				array_push($printed,$user->ID);
				include(locate_template('list-member.php'));
			endif;
		endforeach;
		?>
		<br class="clear" />
	</aside>
	<?
	endif;
}

add_action('get_footer','sfhiv_add_group_events_list',5);
function sfhiv_add_group_events_list(){
	if(!is_singular(array('sfhiv_group'))){
		return true;
	}
	$events = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
	));
	if($events->have_posts()):
	?>
	<aside id="meetings" class="list">
		<h2>Meetings</h2>
		<?
		while($events->have_posts()): $events->the_post();
			get_template_part('list','event');
		endwhile;
		wp_reset_postdata();
		?>
	</aside>
	<?	endif;
}

add_action('get_sidebar','sfhiv_add_parent_page_sidebar',20);
function sfhiv_add_parent_page_sidebar(){
	if(get_post_type()=='sfhiv_group' || get_post_type()=='event'){
		$parent_query = new WP_Query( array(
			'connected_type' => 'parent_page',
			'connected_items' => get_the_ID(),
		));
		while($parent_query->have_posts()){
			$parent_query->the_post();
			sfhiv_draw_page_navigation(get_the_ID());
		}
		wp_reset_postdata();
	}
}

?>