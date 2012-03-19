<?php

add_action('wp_head','sfhiv_years_add_scripts',16);
function sfhiv_years_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/years.js"></script>
	<?
}

add_action('get_sidebar','sfhiv_add_query_years_sidebar',20);
function sfhiv_add_query_years_sidebar(){
	global $wp_query;
	$query = false;
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
		}
	}
	if(is_archive()){
		$wp_query->rewind_posts();
		$query = $wp_query;
	}
	if(!$query): return; endif;
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(count($years)>1):
	sfhiv_draw_taxonomy_filter(array(
		'taxonomy' => 'sfhiv_year',
		'include' => implode(",",$years),
		'title_li' => false,
	));
	endif;
	
}

?>