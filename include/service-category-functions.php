<?php

function sfhiv_draw_service_category_sidebar($query,$args = array()){
	// make sure query post_type is related to sfhiv_year
	$categories = sfhiv_get_taxonomy_in($query,'service_category','ids');
	if(!isset($args['min_display'])) $args['min_display'] = 2;
	if(count($categories) < $args['min_display']) return;
	$args = array_merge(array(
		'taxonomy' => 'service_category',
		'include' => implode(",",$categories),
		'title_li' => 'Service Categories',
	),$args);
	if(!isset($args['base_link']) && is_page()){
		$args['base_link'] = get_permalink();
	}
	sfhiv_draw_taxonomy_menu($args);
}

?>