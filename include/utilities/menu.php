<?php

function sfhiv_draw_menu($args){
	
}

function sfhiv_draw_taxonomy_menu($args){
	?>
	<nav><ul class="menu menu-<?=$args['taxonomy'];?>">
	<?
	$current_categories =  wp_get_object_terms(get_the_ID(),$args['taxonomy'],array('fields'=>'ids'));
	if(count($current_categories) > 0){
		$args['current_category'] = $current_categories[0];
	}
	wp_list_categories($args);
	?></ul></nav><?
}


?>