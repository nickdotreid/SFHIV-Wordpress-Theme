<?php

add_action('get_sidebar','sfhiv_document_archive_add_service_category_menu',21);
function sfhiv_document_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_document') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_service_category',$query);
}

add_action('sfhiv_pre_loop','sfhiv_document_archive_filter_by_years',22,2);
function sfhiv_document_archive_filter_by_years($query=false,$args=array()){
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_document') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_year',$query,array(
		'title_li' => false,
		'extra_classes' => 'filter filter-horizontal',
		'base_link' => get_permalink(),
	));
	echo '<br class="clear" />';
}

?>