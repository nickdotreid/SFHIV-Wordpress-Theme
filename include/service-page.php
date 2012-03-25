<?php

add_action('get_sidebar','sfhiv_service_page_back_to_index',20);
function sfhiv_service_page_back_to_index(){
	if(is_singular('sfhiv_service')){
		?>
		<nav>
			<ul class="menu">
				<li><a href="<?=get_post_type_archive_link('sfhiv_service');?>"><?_e("All Services");?></a></li>
			</ul>
		</nav>
		<?
	}
}

add_action('get_sidebar','sfhiv_service_page_service_type',21);
function sfhiv_service_page_service_type(){
	if (!is_singular('sfhiv_service')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_service_category'));
	$service_categories = sfhiv_get_taxonomy_in($query,'sfhiv_service_category','ids');
	if(count($service_categories)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_service_category',
		'include' => implode(",",$service_categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_service' ),
		'title_li' => 'Services',
	));
}

add_action('get_sidebar','sfhiv_service_page_population_categories',21);
function sfhiv_service_page_population_categories(){
	if (!is_singular('sfhiv_service')) return;
	$query = get_similar_to(get_post(get_the_ID()),array('sfhiv_population_category'));
	$categories = sfhiv_get_taxonomy_in($query,'sfhiv_population_category','ids');
	if(count($categories)<1) return;
	sfhiv_draw_taxonomy_menu(array(
		'taxonomy' => 'sfhiv_population_category',
		'include' => implode(",",$categories),
		'base_link' =>  get_post_type_archive_link( 'sfhiv_service' ),
		'title_li' => 'Populations',
	));
}

add_action('get_sidebar','sfhiv_service_page_parent_groups',20);
function sfhiv_service_page_parent_groups(){
	if (!is_singular('sfhiv_service')) return;
	$groups = sfhiv_service_get_groups(get_the_ID());
	if(count($groups)<1) return;
	foreach($groups as $group){
		sfhiv_draw_page_navigation($group->ID);
	}
}

function sfhiv_service_get_groups($ID=false){
	if(!$ID){
		$ID = get_the_ID();
	}
	$groups = new WP_Query( array(
		'connected_type' => 'group_services',
		'connected_items' => $ID,
	));
	return $groups->posts;
}

?>