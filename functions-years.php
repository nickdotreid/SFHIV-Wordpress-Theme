<?php

add_action('wp_head','sfhiv_years_add_scripts',16);
function sfhiv_years_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/years.js"></script>
	<?
}

add_action('get_sidebar','sfhiv_add_mini_archive_years_sidebar',20);
function sfhiv_add_mini_archive_years_sidebar(){
	if(is_page()){
		$archive_type = mini_archive_on_page(get_the_ID());
		if($archive_type){
			$query = mini_archive_get_query(get_the_ID());
			$years = sfhiv_get_years_in($query,'ids');
			if(count($years)>0):
				?><nav>
					<ul class="menu filters years"><?
					if(count($years)>1):
						?><li class="menu-item"><a href="#" class="js-only filter default">All Years</a></li><?
					endif;
			wp_list_categories(array(
				'taxonomy' => 'year',
				'include' => implode(",",$years),
				'title_li' => false,
			));
				?></ul></nav><?
			endif;
		}
	}
}

function sfhiv_get_years_in($query,$fields=false){
	$years = array();
	$args = array();
	if($fields){
		$args['fields'] = $fields;
	}
	foreach($query->posts as $post){
		$post_years = wp_get_object_terms($post->ID,'year',$args);
		foreach($post_years as $year){
			if(!in_array($year,$years)){
				array_push($years,$year);
			}
		}
	}
	return $years;
}


?>