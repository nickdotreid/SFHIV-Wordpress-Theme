<?php

function sfhiv_draw_population_category_sidebar($query,$args = array()){
	// make sure query post_type is related to sfhiv_year
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_population_category','ids');
	if(!isset($args['min_display'])) $args['min_display'] = 2;
	if(count($categories) < $args['min_display']) return;
	$args = array_merge(array(
		'taxonomy' => 'sfhiv_population_category',
		'include' => implode(",",$categories),
		'title_li' => 'Population Category',
	),$args);
	if(!isset($args['base_link']) && is_page()){
		$args['base_link'] = get_permalink();
	}
	sfhiv_draw_taxonomy_menu($args);
}

?>