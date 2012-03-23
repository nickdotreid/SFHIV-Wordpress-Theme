<?php

add_action('get_sidebar','sfhiv_document_archive_add_service_category_menu',21);
function sfhiv_document_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_document') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query);
}

?>