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
		// get wp_query
		$wp_query->rewind_posts();
		$query = $wp_query;
	}
	if(!$query): return; endif;
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(count($years)>0):
		?><nav>
			<ul class="menu filters years"><?
			if(count($years)>1):
				?><li class="menu-item"><a href="#" class="js-only filter default">All Years</a></li><?
			endif;
	wp_list_categories(array(
		'taxonomy' => 'sfhiv_year',
		'include' => implode(",",$years),
		'title_li' => false,
	));
		?></ul></nav><?
	endif;
	
}

function sfhiv_get_taxonomy_in($query,$taxonomy_name,$fields=false){
	$taxonomies = array();
	$args = array();
	if($fields){
		$args['fields'] = $fields;
	}
	foreach($query->posts as $post){
		$post_taxonomies = wp_get_object_terms($post->ID,$taxonomy_name,$args);
		foreach($post_taxonomies as $taxonomy){
			if(!in_array($taxonomy,$taxonomies)){
				array_push($taxonomies,$taxonomy);
			}
		}
	}
	foreach($taxonomies as $taxonomy){	// loop all entries to error check
		if(array_key_exists('invalid_taxonomy',$taxonomy)){
			return array();
		}
	}
	if(!$fields){
		usort($taxonomies,function($a,$b){
			if($a->term_order > $b->term_order){
				return 1;
			}
			return 0;
		});
	}
	return $taxonomies;
}


?>