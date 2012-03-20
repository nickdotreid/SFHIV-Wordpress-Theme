<?php

add_action('wp_head','sfhiv_years_add_scripts',16);
function sfhiv_years_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/years.js"></script>
	<?
}

function sfhiv_draw_years_category_sidebar($query,$args=array()){
	// make sure query post_type is related to sfhiv_year
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(!isset($args['min_display'])) $args['min_display'] = 2;
	if(count($categories) < $args['min_display']) return;
	$args = array_merge(array(
		'taxonomy' => 'sfhiv_year',
		'include' => implode(",",$categories),
		'title_li' => 'Years',
	),$args);
	if(!isset($args['base_link']) && is_page()){
		$args['base_link'] = get_permalink();
	}
	sfhiv_draw_taxonomy_menu($args);
}

?>