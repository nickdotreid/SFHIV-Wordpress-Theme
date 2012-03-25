<?php


function sfhiv_draw_page_navigation($post_ids,$args=array()){
	extract($args);
	if(!is_array($post_ids)){
		$post_ids = array($post_ids);
	}
	$ids_to_show = array();
	?><nav><?
	foreach($post_ids as $ID){
		array_push($ids_to_show,$ID);
		$children = get_pages(array(
			"parent"=>$ID,
			"hierarchical" => 0,
			"post_type" => get_post_type($ID),
			));
		foreach($children as $child){
			array_push($ids_to_show,$child->ID);
		}
		$parents = get_ancestors($ID,get_post_type($ID));
		foreach($parents as $parent){
			array_push($ids_to_show,$parent);
		}
		if(count($parents)>0){
			$parent_ID = $parents[0];
			$siblings = get_pages(array(
				"parent"=>$parent_ID,
				"hierarchical" => 0,
				"post_type" => get_post_type($ID),
			));
			foreach($siblings as $sibling){
				array_push($ids_to_show,$sibling->ID);
			}
		}
	}
	
	wp_page_menu(array( 
		'show_home' => false,
		'sort_column' => 'menu_order',
		'include' => implode(",",$ids_to_show),
		'post_type' => get_post_type($ID),
		));
	?></nav><?
}

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
	if(is_singular()):
		$current_categories =  wp_get_object_terms(get_the_ID(),$args['taxonomy'],array('fields'=>'ids'));
		if(count($current_categories) > 0){
			$args['current_category'] = $current_categories[0];
		}
	endif;
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

function sfhiv_draw_taxonomy_query_menu($tax_name,$query,$args = array()){
	if(!is_object_in_taxonomy($query->query_vars['post_type'],$tax_name)) return;
	
	$query = sfhiv_remove_url_vars_from_query($query,array($tax_name));
	
	$categories = sfhiv_get_taxonomy_in($query,$tax_name,'ids');
	
	if(!isset($args['min_display'])) $args['min_display'] = 2;
	if(count($categories) < $args['min_display']) return;
	
	if(!isset($args['base_link'])){
		if(is_page() && mini_archive_on_page(get_the_ID()))
			$args['base_link'] = get_permalink();
		else
			$args['base_link'] = get_post_type_archive_link( $query->query_vars['post_type'] );
	}
	
	if(!isset($args['title_li'])){
		$taxonomies = get_taxonomies(array(
			'name' => $tax_name,
		),'objects');
		foreach($taxonomies as $taxonomy){
			$args['title_li'] = $taxonomy->label;
		}
	}
	
	$args = array_merge(array(
		'taxonomy' => $tax_name,
		'include' => implode(",",$categories),
	),$args);
	
	sfhiv_draw_taxonomy_menu($args);
}


?>