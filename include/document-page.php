<?php

add_action('get_sidebar','sfhiv_add_document_navigation',22);
function sfhiv_add_document_navigation(){
	if(is_singular('sfhiv_document')){
		sfhiv_draw_page_navigation(array(get_the_ID()));
	}
}

add_action('get_sidebar','sfhiv_document_studies_sidebar',23);
function sfhiv_document_studies_sidebar(){
	if(!is_singular('sfhiv_document')) return;
	$studies = sfhiv_document_get_studies();
	if($studies->post_count < 1) return;
	sfhiv_draw_menu($studies->posts,array(
		'show_parents' => true,
	));
}

?>