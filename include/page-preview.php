<?php

add_action('sfhiv-preview-menu','sfhiv_preview_add_bottom_link',15);
function sfhiv_preview_add_bottom_link(){
	sfhiv_draw_menu(array(
			get_post(get_the_ID()),
		),array(
			'selected_items' => array(get_the_ID()),
		));
}

add_action('sfhiv-preview-menu','sfhiv_page_preview_add_child_pages',2);
function sfhiv_page_preview_add_child_pages(){
	$children = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => get_post_type(get_the_ID()),
		));
	if(count($children)<1) return;
	sfhiv_draw_menu($children);
}

add_action('sfhiv-preview-menu','sfhiv_add_mini_archive_menu',3);
function sfhiv_add_mini_archive_menu(){
	$archive_type = mini_archive_on_page(get_the_ID());
	if($archive_type):
		$output_archive = false;
		$query = mini_archive_get_query(get_the_ID());
		if(in_array($archive_type,array(
			'event',
		))){
			$groups = sfhiv_get_related_in($query,'group_events');
			if(count($groups) > 0){
				$output_archive = true;
				sfhiv_draw_menu($groups);
			}
		}
		$archive_filters = mini_archive_get_filters();
		foreach($archive_filters as $filter){
			if(!$output_archive){
				$taxes = sfhiv_get_taxonomy_in($query,$filter['type'],'ids');
				if(count($taxes) > 1){
					$output_archive = true;
					sfhiv_draw_taxonomy_menu(array(
						'taxonomy' => $filter['type'],
						'title_li' => false,
						'include' => implode(',',$taxes),
						'show_all_link' => false,
						'base_link' => get_permalink(get_the_ID()),
					));
				}
			}
		}
		if(!$output_archive):
			$query = mini_archive_get_query(get_the_ID(),array(
				'posts_per_page' => 3,
			));
			?><nav><ul class="menu"><?
			foreach($query->posts as $post){
				//$query->the_post();
				echo '<li class="menu-item">';
				echo '<a href="'.get_permalink($post->ID).'">';
				do_action("sfhiv_pre_link");
				echo apply_filters('the_title',$post->post_title);
				echo '</a>';
				echo '</li>';
			}
			?></ul></nav><?
		endif;
	endif;
}




?>