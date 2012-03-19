<?php

function sfhiv_draw_menu($posts=array()){
	$menu_templates = array('menu.php');
	$template = locate_template($menu_templates);
	if($template){
		include $template;
	}
}

function sfhiv_draw_menu_item($post){
	$menu_templates = array();
	if($post && $post->post_type){
		array_push($menu_templates,'menu-item'.$post->post_type.'.php');
	}
	array_push($menu_templates,'menu-item.php');
	$template = locate_template($menu_templates);
	if($template){
		include $template;
	}
}

function sfhiv_draw_taxonomy_menu($args){
	?>
	<nav><ul class="menu menu-<?=$args['taxonomy'];?>">
	<?
	$current_categories =  wp_get_object_terms(get_the_ID(),$args['taxonomy'],array('fields'=>'ids'));
	if(count($current_categories) > 0){
		$args['current_category'] = $current_categories[0];
	}
	$args['walker'] = new SFHIV_Category_Walker_Menu();
	wp_list_categories($args);
	?></ul></nav><?
}

function sfhiv_draw_taxonomy_filter($args){
	$args['walker'] = new SFHIV_Category_Walker_Filter();
	?>
	<form class="filters" action="" method="get">
		<ul class="menu">
			<?	wp_list_categories($args);	?>
		</ul>
		<input type="submit" value="Update Query" />
	</form>
	<?
}


?>