<?php

include_once('walker_category_menu.php');

function make_filter_walker_link($category,$href=false){
	if(!$href) $href = $_SERVER['REQUEST_URI'];
	$argument = $category->slug;
	if(isset($_GET[$category->taxonomy])){
		$argument = $_GET[$category->taxonomy].",".$category->slug;
	}
	$href = add_query_arg($category->taxonomy,$argument,$href);
	return $href;
}

class SFHIV_Category_Walker_Filter extends SFHIV_Category_Walker_Menu {
	function draw_link($category,$args){
		extract($args);
		
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = "";
		if(!empty($base_link) && $base_link) $href = make_filter_walker_link($category,$base_link);
		else make_filter_walker_link($category);
		$href = remove_query_arg( "page", $href );
		$link .= '<a href="';
		$link .= $href.'" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		$link .= '>';
		$link .= $cat_name . '</a>';

		return $link;
	}
}

?>