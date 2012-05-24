<?php

function sfhiv_make_menu_walker_category_link($category,$href=false,$add=true){
	if(!$href){
		$href = esc_attr( get_term_link($category) );
	}
	if($add)	$href = add_query_arg($category->taxonomy,$category->slug,$href);
	else $href = remove_query_arg($category->taxonomy,$href);
	
	return $href;
}

class SFHIV_Category_Walker_Menu extends Walker_Category {
	
	var $displayed_show_all = false;
	
	function start_el(&$output, $category, $depth, $args) {
		extract($args);
		
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = "";
		if(!empty($base_link) && $base_link) $href = sfhiv_make_menu_walker_category_link($category,$base_link);
		else $href = sfhiv_make_menu_walker_category_link($category);
		$href = remove_query_arg( "page", $href );
		$link .= '<a href="';
		$link .= $href.'" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		$link .= '>';
		$link .= $cat_name . '</a>';



		if ( !empty($feed_image) || !empty($feed) ) {
			$link .= ' ';

			if ( empty($feed_image) )
				$link .= '(';

			$link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';

			if ( empty($feed) ) {
				$alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
			} else {
				$title = ' title="' . $feed . '"';
				$alt = ' alt="' . $feed . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( empty($feed_image) )
				$link .= $name;
			else
				$link .= "<img src='$feed_image'$alt$title" . ' />';

			$link .= '</a>';

			if ( empty($feed_image) )
				$link .= ')';
		}

		if ( !empty($show_count) )
			$link .= ' (' . intval($category->count) . ')';

		if ( !empty($show_date) )
			$link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
		
		if($show_all_link && !$this->displayed_show_all){
			$this->displayed_show_all = true;
			$taxonomy = get_taxonomy($category->taxonomy);
			
			if(!empty($base_link) && $base_link) $href = sfhiv_make_menu_walker_category_link($category,$base_link,false);
			else $href = sfhiv_make_menu_walker_category_link($category,false,false);
			if ( 'list' == $args['style'] ) {
				$output .= "\t<li";
				$class = 'cat-item cat-item-' . $category->term_id;
				if(!in_array($category->taxonomy,array_keys($_GET)) && (is_archive())){
					$class .= " current-cat";
				}
				$output .=  ' class="' . $class . '"';
				$output .= ">";
			}
			$output .= '<a href="'.$href.'">';
			if(isset($all_taxonomy_name))
				$output .= $all_taxonomy_name;
			else
				$output .= "All ".$taxonomy->label;
			$output .= '</a>';
			if ( 'list' == $args['style'] ) {
				$output .= "</li>";
			}else{
				$output.="<br />";
			}
		}
		
		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			if(in_array($category->taxonomy,array_keys($_GET))){
				if($_GET[$category->taxonomy]==$category->slug){
					$class .= " current-cat";
				}
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}

?>