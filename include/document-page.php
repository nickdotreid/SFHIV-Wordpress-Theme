<?php

require_once('utilities/query_mapper.php');

add_action('get_sidebar','sfhiv_document_page_document_categories',21);
function sfhiv_document_page_document_categories(){
	if (!is_singular('sfhiv_document')) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_document_category',
		'title_li' => false,
		'current_category' => $current_categories[0],
		'base_link' =>  get_post_type_archive_link( 'sfhiv_document' ),
	));
}


add_action('get_sidebar','sfhiv_document_page_service_categories',22);
function sfhiv_document_page_service_categories(){
	if (!is_singular('sfhiv_document')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_service_category'));
	$service_categories = sfhiv_get_taxonomy_in($query,'sfhiv_service_category','ids');
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_service_category',
		'title_li' => false,
		'include' => implode(",",$service_categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_document' ),
	));
}

add_action('get_sidebar','sfhiv_document_page_similar_menu',23);
function sfhiv_document_page_similar_menu(){
	if (!is_singular('sfhiv_document')) return;
	$query = get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 1 ){
		sfhiv_draw_menu($query->posts);
	}
}

?>