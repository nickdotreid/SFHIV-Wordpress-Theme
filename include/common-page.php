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

add_action('get_sidebar','sfhiv_page_show_linked_page',10);
function sfhiv_page_show_linked_page(){
	if(!is_singular()) return;
	$page = sfhiv_link_to_page_get_page(get_the_ID());
	sfhiv_draw_menu(array($page));
}

add_action('after_content','sfhiv_page_list_attachments',5);
function sfhiv_page_list_attachments(){
	if(!is_singular()) return;
	$attachments = new WP_Query(array(
		'post_status' => 'any',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'nopaging' => true,
		'orderby' => 'menu_order',
		'post_mime_type' => 'application/pdf,application/msword'
		) );
	do_action('sfhiv_loop',$attachments,array(
		"id" => "attachments",
		"list_element" => "list",
	));
}

?>