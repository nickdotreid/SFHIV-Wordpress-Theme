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

add_action('get_sidebar','sfhiv_groups_in_query_sidebar',25);
function sfhiv_groups_in_query_sidebar(){
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		// get wp_query
	}
	if(!$query): return; endif;
	$groups = sfhiv_get_related_in($query,'group_events');
	if(count($groups)>0){
		$query = new WP_Query( array( 'post__in' => $groups, 'post_type'=>'sfhiv_group' ) );
		if($query->post_count > 0):
			?><nav><ul class="menu groups filters"><?
			if($query->post_count > 1){
				?><li class="" slug=""><a href="" slug="">All Groups</a></li><?
			}
			while($query->have_posts()):
				$query->the_post();
				get_template_part('menu-item','sfhiv_group');
			endwhile;
			?></ul></nav><?
		endif;
		wp_reset_postdata();				
	}
}

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
				if(!in_array($related->ID,$related_objects)){
					array_push($related_objects,$related->ID);
				}
			}
		}
	}
	return $related_objects;
}

add_action('get_sidebar','sfhiv_add_query_group_cat_sidebar',21);
function sfhiv_add_query_group_cat_sidebar(){
	global $wp_query;
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		// get wp_query
		$wp_query->rewind_posts();
		$query = $wp_query;
	}
	if(!$query): return; endif;
	$groups = sfhiv_get_taxonomy_in($query,'sfhiv_group_category','ids');
	if(count($groups)>0):
		?><nav>
			<ul class="menu filters groups"><?
			if(count($groups)>1):
				?><li class="menu-item"><a href="#" class="js-only filter default">All Groups</a></li><?
			endif;
	wp_list_categories(array(
		'taxonomy' => 'sfhiv_group_category',
		'include' => implode(",",$groups),
		'title_li' => false,
	));
		?></ul></nav><?
	endif;
}

?>