<?php

require_once('utilities/query_mapper.php');
require_once('utilities/menu_wrapper.php');

add_action('get_sidebar','sfhiv_group_page_add_featured_image',20);
function sfhiv_group_page_add_featured_image(){
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
	$query = get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 0 ){
		sfhiv_draw_menu($query->posts);
	}
}

add_action('get_sidebar','sfhiv_group_page_group_by_years',24);
function sfhiv_group_page_group_by_years(){
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_year'));
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(count($years)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_year',
		'title_li' => false,
		'include' => implode(",",$years),
		'current_category' => $current_categories[0],
		'base_link' =>  get_post_type_archive_link( 'sfhiv_group' ),
	));
}

add_action('get_footer','sfhiv_group_page_list_group_members',20);
function sfhiv_group_page_list_group_members(){
	if (!is_singular('sfhiv_group')) return;
	if(sfhiv_group_has_members()):
	$users = sfhiv_group_get_members();	?>
	<section id="members" class="list">
		<h2 class="list-title">Members</h2>
		<?
		$show_incomplete = false;
		foreach($users as $user):
			if(!p2p_get_meta( $user->p2p_id, 'incomplete', true ))
				include(locate_template('list-member.php'));
			else
				$show_incomplete = true;
		endforeach;
		if($show_incomplete):
		?>
		<h3>Members unable to complete term.</h3>
		<?	foreach($users as $user):
			if(p2p_get_meta( $user->p2p_id, 'incomplete', true ))	include(locate_template('list-member.php'));
		endforeach;
		endif;
		?>
		<br class="clear" />
	</section><!-- #members -->
	<?	endif;
}

add_action('get_footer','sfhiv_group_page_list_group_events',21);
function sfhiv_group_page_list_group_events(){
	if (!is_singular('sfhiv_group')) return;
	$events = sfhiv_group_get_events();
	do_action('sfhiv_loop',$events,array(
		"id" => "events",
		"title" => "Events",
	));
}

add_action('get_footer','sfhiv_group_page_list_group_services',22);
function sfhiv_group_page_list_group_services(){
	if (!is_singular('sfhiv_group')) return;
	$services = sfhiv_group_get_services();
	do_action('sfhiv_loop',$services,array(
		"id" => "services",
		"title" => "Services",
		"list_element" => "list-item",
	));
}

?>