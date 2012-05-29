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
		if(!isset($show_children) || $show_children){
			$children = get_pages(apply_filters('sfhiv_filter_args',array(
				"parent"=>$ID,
				"hierarchical" => 0,
				"post_type" => get_post_type($ID),
				)));
			foreach($children as $child){
				array_push($ids_to_show,$child->ID);
			}
		}
		$parents = get_ancestors($ID,get_post_type($ID));
		if(!isset($show_parents) || $show_parents){
			foreach($parents as $parent){
				array_push($ids_to_show,$parent);
			}
		}
		if(!isset($show_siblings) || $show_siblings){
			if(count($parents)>0){
				$parent_ID = $parents[0];
				$siblings = get_pages(apply_filters('sfhiv_filter_args',array(
					"parent"=>$parent_ID,
					"hierarchical" => 0,
					"post_type" => get_post_type($ID),
				)));
				foreach($siblings as $sibling){
					array_push($ids_to_show,$sibling->ID);
				}
			}
		}
	}
	wp_page_menu(array_merge($args,array( 
		'show_home' => false,
		'sort_column' => 'menu_order',
		'include' => implode(",",$ids_to_show),
		'post_type' => get_post_type($ID),
		'walker' => new SFHIV_Post_Type_Walker_Menu(),
		)));
	?></nav><?
}

function sfhiv_draw_menu($posts=array(),$args = array()){
	$ids = array();
	foreach($posts as $post){
		array_push($ids,$post->ID);
	}
	sfhiv_draw_page_navigation($ids,array_merge(array(
		"show_children" => false,
		"show_siblings" => false,
		"show_parents" => false,
	),$args));
}

function sfhiv_draw_taxonomy_menu($args){
	echo '<nav><ul class="menu menu-'.$args['taxonomy'].' '.$args['extra_classes'].'">';
	if(is_singular()):
		$current_categories =  wp_get_object_terms(get_the_ID(),$args['taxonomy'],array('fields'=>'ids'));
		if(is_array($current_categories) && count($current_categories) > 0){
			$args['current_category'] = $current_categories[0];
		}
	endif;
	if(!isset($args['walker'])) $args['walker'] = new SFHIV_Category_Walker_Menu();
	wp_list_categories($args);
	echo "</ul></nav>";
}

function sfhiv_draw_taxonomy_query_menu($tax_name,$query,$args = array()){
	if(!is_object_in_taxonomy($query->query_vars['post_type'],$tax_name)) return;
	
	if(!isset($args['include'])){
		$query = sfhiv_remove_url_vars_from_query($query,array($tax_name));
		$query = sfhiv_unpage_query($query);
		
		$categories = sfhiv_get_taxonomy_in($query,$tax_name,'ids');
		$args['include'] = implode(",",$categories);
		
		if(!isset($args['min_display'])) $args['min_display'] = 2;
		if(count($categories) < $args['min_display']) return;
	}
		
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
		'show_all_link' => true,
	),$args);
	sfhiv_draw_taxonomy_menu($args);
}


?>