<?php

add_action('sfhiv-preview-menu','sfhiv_preview_add_bottom_link',15);
function sfhiv_preview_add_bottom_link(){
	echo '<a href="'.get_permalink().'" class="clear preview-bottom">';
	echo get_the_title();
	echo '</a>';
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
	global $post;
	$archive_type = mini_archive_on_page(get_the_ID());
	if($archive_type && !is_home()):
		$output_archive = false;
		$query = mini_archive_get_query(get_the_ID());
		if(!in_array($archive_type,array(
			'sfhiv_event',
		))){
			$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
			if(count($years)>1){
				$output_archive = true;
				sfhiv_draw_taxonomy_menu(array(
					'taxonomy' => 'sfhiv_year',
					'title_li' => false,
					'include' => implode(',',$years),
					'show_all_link' => false,
					'base_link' => get_permalink(get_the_ID()),
				));
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
		if(is_home()){
			$output_archive = true;
			echo "FOO";
		}
		if(!$output_archive && !in_array($archive_type,array(
			'sfhiv_service',
			'sfhiv_service_hour',
		))):
			$query = mini_archive_get_query(get_the_ID(),array(
				'posts_per_page' => 3,
			));
			$org_post = $post;
			?><nav><ul class="menu"><?
			foreach($query->posts as $post){
				get_template_part('list-item',get_post_type());
			}
			$post = $org_post;
			?></ul></nav><?
		endif;
	endif;
}




?>