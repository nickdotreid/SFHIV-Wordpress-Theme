<?php

class SFHIV_Category_Walker_Filter extends Walker_Category {
	function start_el(&$output, $category, $depth, $args){
		extract($args);

		$cat_name = esc_attr( $category->name);
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$filter = '<label class="checkbox"><input type="checkbox" ';
		$filter .= 'name="'.$category->taxonomy.'" ';
		$filter .= 'value="'.$category->slug.'" ';
		
		if(true){ // check filter state by args or $_GET?
			$filter .= 'checked="checked" ';
		}
		
		$filter .= '/>';
		$filter .= $cat_name;

		if ( isset($show_count) && $show_count )
			$link .= ' (' . intval($category->count) . ')';

		if ( isset($show_date) && $show_date ) {
			$link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
		}
		
		$filter .='</label>';

		if ( isset($current_category) && $current_category )
			$_current_category = get_category( $current_category );

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-'.$category->term_id;
			if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
				$class .=  ' current-cat';
			elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
				$class .=  ' current-cat-parent';
			$output .=  ' class="'.$class.'"';
			$output .= ">$filter\n";
		} else {
			$output .= "\t$filter<br />\n";
		}
	}	
}

?>