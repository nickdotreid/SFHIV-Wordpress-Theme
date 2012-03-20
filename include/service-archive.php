<?php

include_once('service-category-functions.php');
add_action('get_sidebar','sfhiv_service_archive_add_service_category',21);
function sfhiv_service_archive_add_service_category(){
	$query = sfhiv_get_archive_query();
	if(!$query): return; endif;
	sfhiv_draw_service_category_sidebar($query,array(
		'base_link' => get_post_type_archive_link( 'sfhiv_service' ),
	));
}

?>