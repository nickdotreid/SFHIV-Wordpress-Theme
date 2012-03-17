<?php

add_action('get_sidebar','sfhiv_group_page_groups_by_year',20);
function sfhiv_group_page_groups_by_year(){
	if (!is_singular('sfhiv_group')) return;
	$tax_query = array(
		'relation' => 'and',
	);
	foreach(get_object_taxonomies('sfhiv_group') as $taxonomy){
		$tax_ids = wp_get_object_terms(get_the_ID(),$taxonomy,array('fields'=>'ids'));
		if(count($tax_ids)>0){
			array_push($tax_query,array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $tax_ids,
			));
		}
	}
	$query = new WP_Query(array(
		'post_type' => 'sfhiv_group',
		'tax_query' => $tax_query,
	));
	?>
	<nav><ul class="menu">
	<?
	while($query->have_posts()):
		$query->the_post();
		get_template_part('menu-item','sfhiv_group');
	endwhile;
	wp_reset_postdata();
	?>
	</ul></nav>
	<?
}

add_action('get_sidebar','sfhiv_group_page_group_by_years',21);
function sfhiv_group_page_group_by_years(){
	if (!is_singular('sfhiv_group')) return;
	$tax_query = array(
		'relation' => 'and',
	);
	foreach(get_object_taxonomies('sfhiv_group') as $taxonomy){
		if($taxonomy!='sfhiv_year'):
			$tax_ids = wp_get_object_terms(get_the_ID(),$taxonomy,array('fields'=>'ids'));
			if(count($tax_ids)>0){
				array_push($tax_query,array(
					'taxonomy' => $taxonomy,
					'field' => 'id',
					'terms' => $tax_ids,
				));
			}
		endif;
	}
	$query = new WP_Query(array(
		'post_type' => 'sfhiv_group',
		'tax_query' => $tax_query,
	));
	$years = sfhiv_get_taxonomy_in($query,'sfhiv_year');
	?>
	<nav><ul class="menu">
	<?
	foreach($years as $year){
		?>
		<li><a href="/groups/?sfhiv_year=<?=$year->slug;?>"><?=$year->name;?></a></li>
		<?
	}
	?></ul></nav><?
}
?>