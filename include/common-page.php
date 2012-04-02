<?php

add_action('get_sidebar','sfhiv_add_parent_page_sidebar',10);
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

add_action('after_content','sfhiv_page_list_attachments',5);
function sfhiv_page_list_attachments(){
	if(!is_singular()) return;
	$attachments = new WP_Query(array(
		'post_status' => 'any',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		) );
	do_action('sfhiv_loop',$attachments,array(
		"id" => "attachments",
		"list_element" => "list",
	));
}


add_action('before_content','sfhiv_page_add_featured_image',12);
function sfhiv_page_add_featured_image(){
	if ( has_post_thumbnail() ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id() , 'featured-size' );
		if($thumbnail){
			$background_image = $thumbnail[0];
			echo '<img src="'.$background_image.'" class="featured" />';
		}
	}
}

?>