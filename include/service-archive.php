<?php

include_once('service-category-functions.php');
add_action('get_sidebar','sfhiv_service_archive_add_service_category_menu',21);
function sfhiv_service_archive_add_service_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service') return;
	sfhiv_draw_taxonomy_query_menu('service_category',$query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_service' ),
	));
}

add_action('get_sidebar','sfhiv_service_archive_add_population_category_menu',21);
function sfhiv_service_archive_add_population_category_menu(){
	$query = sfhiv_get_archive_query();
	if(!$query || $query->query_vars['post_type'] != 'sfhiv_service') return;
	sfhiv_draw_taxonomy_query_menu('sfhiv_population_category',$query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_service' ),
	));
}

?>