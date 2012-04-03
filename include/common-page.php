<?php

add_action('get_sidebar','sfhiv_page_show_linked_page',11);
function sfhiv_page_show_linked_page(){
	if(!is_singular()) return;
	$page = sfhiv_link_to_page_get_page(get_the_ID());
	if(!$page) return;
	sfhiv_draw_menu(array($page),array(
		"show_parents" => true,
	));
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