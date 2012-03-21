<?php

require_once('utilities/query_mapper.php');
require_once('utilities/menu_wrapper.php');


add_action('get_sidebar','sfhiv_group_page_back_to_index',20);
function sfhiv_group_page_back_to_index(){
	if(is_singular('sfhiv_group')){
		?>
		<nav>
			<ul class="menu">
				<li><a href="<?=get_post_type_archive_link('sfhiv_group');?>"><?_e("All Groups");?></a></li>
			</ul>
		</nav>
		<?
	}
}

add_action('get_sidebar','sfhiv_group_page_groups_by_year',22);
function sfhiv_group_page_groups_by_year(){
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()));
	if($query->post_count > 0 ){
		sfhiv_draw_menu($query->posts);
	}
}

add_action('get_sidebar','sfhiv_group_page_group_by_years',24);
function sfhiv_group_page_group_by_years(){
	if (!is_singular('sfhiv_group')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_year'));
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year','ids');
	if(count($years)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_year',
		'title_li' => false,
		'include' => implode(",",$years),
		'current_category' => $current_categories[0],
		'base_link' =>  get_post_type_archive_link( 'sfhiv_group' ),
	));
}
?>