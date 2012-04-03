<?php

add_action('before_content','sfhiv_event_page_show_date',12);
function sfhiv_event_page_show_date(){
	echo '<div class="event_date_time">';
	get_template_part('date','event');
	echo '</div>';
}

add_action('get_sidebar','sfhiv_event_page_back_to_index',20);
function sfhiv_event_page_back_to_index(){
	if(is_singular('sfhiv_event')){
		?>
		<nav>
			<ul class="menu">
				<li><a href="<?=get_post_type_archive_link('sfhiv_event');?>"><?_e("All Events");?></a></li>
			</ul>
		</nav>
		<?
	}
}

add_action('get_sidebar','sfhiv_event_page_event_categories',23);
function sfhiv_event_page_event_categories(){
	if (!is_singular('sfhiv_event')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_event_category'));
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_event_category','ids');
	if(count($categories)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_event_category',
		'include' => implode(",",$categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_event' ),
		'title_li' => 'Event Categories',
	));
}

add_action('get_sidebar','sfhiv_event_page_parent_groups',22);
function sfhiv_event_page_parent_groups(){
	if (!is_singular('sfhiv_event')) return;
	$groups = new WP_Query( array(
		'connected_type' => 'group_events',
		'connected_items' => get_the_ID(),
	));
	if($groups->post_count<1) return;
	$group_ids = array();
	foreach($groups->posts as $group){
		$group_ids[] = $group->ID;
	}
	sfhiv_draw_page_navigation($group_ids,array(
		'selected_items' => $group_ids,
	));
}

?>