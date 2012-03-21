<?
add_action('get_sidebar','sfhiv_add_page_navigation',20);
function sfhiv_add_page_navigation(){
	if(is_page()){
		sfhiv_draw_page_navigation(get_the_ID());
	}
}

function sfhiv_draw_page_navigation($ID){
	?><nav><?
	$children = get_pages(array(
		"parent"=>$ID,
		"hierarchical" => 0,
		"post_type" => get_post_type($ID),
		));
	$children_IDs = array();
	foreach($children as $child){
		array_push($children_IDs,$child->ID);
	}
	$children_IDs = implode(",",$children_IDs);
	$parents = get_ancestors($ID,get_post_type($ID));
	$parent_IDs = implode(",",$parents);
	$page_IDs = $parent_IDs.",".$children_IDs.",".$ID;
	if(count($parents)>0){
		$parent_ID = $parents[0];
		$sibling_IDs = array();
		$siblings = get_pages(array(
			"parent"=>$parent_ID,
			"hierarchical" => 0,
			"post_type" => get_post_type($ID),
		));
		foreach($siblings as $sibling){
			array_push($sibling_IDs,$sibling->ID);
		}
		$page_IDs .= ",".implode(",",$sibling_IDs);
	}
	wp_page_menu(array( 
		'show_home' => false,
		'sort_column' => 'menu_order',
		'include' => $page_IDs,
		'post_type' => get_post_type($ID),
		));
	?></nav><?
}
?>