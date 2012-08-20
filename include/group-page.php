<?php

require_once('utilities/query_mapper.php');
require_once('utilities/menu_wrapper.php');

add_action('get_sidebar','sfhiv_group_page_add_featured_image',20);
function sfhiv_group_page_add_featured_image(){
	if (!is_singular('sfhiv_group')) return;
	if ( has_post_thumbnail() ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id() , 'sidbar' );
		if($thumbnail){
			$background_image = $thumbnail[0];
			echo '<img src="'.$background_image.'" class="featured" />';
		}
	}
}

add_action('get_sidebar','sfhiv_group_page_groups_by_year',22);
function sfhiv_group_page_groups_by_year(){
	if (!is_singular('sfhiv_group')) return;
	$query = sfhiv_get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 0 ){
		sfhiv_draw_menu($query->posts);
	}
}

add_action('navigation','sfhiv_group_navigation_members_link',1);
//add_action('short_navigation','sfhiv_group_navigation_members_link',1);
function sfhiv_group_navigation_members_link(){
	if (get_post_type() != 'sfhiv_group') return;
	if(!sfhiv_group_has_members()) return;
	echo '<a href="'.get_permalink().'#members">Members</a>';
}

add_action('get_footer','sfhiv_group_page_list_group_members',20);
function sfhiv_group_page_list_group_members(){
	if (!is_singular('sfhiv_group')) return;
	if(sfhiv_group_has_members()):
	$users = sfhiv_group_get_members();
	?>
	<section id="members" class="list">
		<h2 class="list-title">Members</h2>
		<?
		$groupings = array();
		foreach($users as $user):
			if(p2p_get_meta( $user->p2p_id, 'group', true )){
				$name = p2p_get_meta( $user->p2p_id, 'group', true );
				if(!isset($groupings[$name])){
					$groupings[$name] = array();
				}
				array_push($groupings[$name],$user);
			}else{
				include(locate_template('list-member.php'));
			}
		endforeach;
		foreach($groupings as $title => $users):
			echo '<h3 class="list-title">';
			_e($title,'sfhiv_theme');
			echo '</h3>';
			foreach($users as $user):
				include(locate_template('list-member.php'));
			endforeach;
		endforeach;
		?>
		<br class="clear" />
	</section><!-- #members -->
	<?	endif;
}

add_action('navigation','sfhiv_group_navigation_event_link',1);
add_action('short_navigation','sfhiv_group_navigation_event_link',1);
function sfhiv_group_navigation_event_link(){
	if (get_post_type() != 'sfhiv_group') return;
	$events = sfhiv_group_get_events();
	if($events->post_count < 1) return;
	echo '<a href="'.get_permalink().'#meetings">Meetings</a>';
}

add_action('get_footer','sfhiv_group_page_list_group_events',21);
function sfhiv_group_page_list_group_events(){
	if (!is_singular('sfhiv_group')) return;
	$events = sfhiv_group_get_events();
	do_action('sfhiv_loop',$events,array(
		"id" => "meetings",
		"title" => "Meetings",
		'show_empty' => false,
		'show_filters' => false,
	));
}

add_action('navigation','sfhiv_group_navigation_services_link',1);
add_action('short_navigation','sfhiv_group_navigation_services_link',1);
function sfhiv_group_navigation_services_link(){
	if (get_post_type() != 'sfhiv_group') return;
	$services = sfhiv_group_get_services();
	if($services->post_count < 1) return;
	echo '<a href="'.get_permalink().'#services">Services</a>';
}

add_action('get_footer','sfhiv_group_page_list_group_services',22);
function sfhiv_group_page_list_group_services(){
	if (!is_singular('sfhiv_group')) return;
	$services = sfhiv_group_get_services();
	do_action('sfhiv_loop',$services,array(
		"id" => "services",
		"title" => "Services",
		"list_element" => "short",
		"show_filters" => false,
	));
}

add_action('navigation','sfhiv_group_navigation_studies_link',1);
//add_action('short_navigation','sfhiv_group_navigation_studies_link',1);
function sfhiv_group_navigation_studies_link(){
	if (get_post_type() != 'sfhiv_group') return;
	$studies = sfhiv_group_get_studies();
	if($studies->post_count < 1) return;
	echo '<a href="'.get_permalink().'#studies">Studies</a>';
}

add_action('get_footer','sfhiv_group_page_list_group_studies',23);
function sfhiv_group_page_list_group_studies(){
	if (!is_singular('sfhiv_group')) return;
	$studies = sfhiv_group_get_studies();
	do_action('sfhiv_loop',$studies,array(
		"id" => "studies",
		"title" => "Studies",
		'show_filters' => false
	));
}

?>