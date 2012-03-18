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
		));
	$children_IDs = array();
	foreach($children as $child){
		array_push($children_IDs,$child->ID);
	}
	$children_IDs = implode(",",$children_IDs);
	$parents = get_ancestors($ID,'page');
	$parent_IDs = implode(",",$parents);
	$page_IDs = $parent_IDs.",".$children_IDs.",".$ID;
	if(count($parents)>0){
		$parent_ID = $parents[0];
		$sibling_IDs = array();
		$siblings = get_pages(array(
			"parent"=>$parent_ID,
			"hierarchical" => 0,
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
		));
	?></nav><?
}

add_action('sfhiv-preview-menu','sfhiv_add_mini_archive_menu');
function sfhiv_add_mini_archive_menu(){
	$archive_type = mini_archive_on_page(get_the_ID());
	if($archive_type):
		$output_archive = false;
		$query = mini_archive_get_query(get_the_ID());
		$archive_filters = mini_archive_get_filters();
		foreach($archive_filters as $filter){
			if(!$output_archive){
				$years = sfhiv_get_taxonomy_in($query,'sfhiv_years');
				if(count($years) > 1){
					$output_archive = true;
					?>
					<nav><ul class="menu">
					<?
					foreach($years as $year){
						?>
						<li class="menu-item"><a href="<?the_permalink();?>#<?=$year->slug;?>"><?=$year->name;?></a></li>
						<?
					}
					?>
					</ul></nav>
					<?
				}
			}
		}
		if(!$output_archive):
			$query = mini_archive_get_query(get_the_ID(),3);
			?><nav><ul class="menu"><?
			while($query && $query->have_posts()){
				$query->the_post();
				get_template_part( 'menu-item', $archive_type );
			}
			?></ul></nav><?
		endif;
	endif;
}

?>