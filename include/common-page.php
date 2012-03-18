<?php

add_action('get_sidebar','sfhiv_add_parent_page_sidebar',10);
function sfhiv_add_parent_page_sidebar(){
	if(get_post_type()=='sfhiv_group' || get_post_type()=='event'){
		$parent_query = new WP_Query( array(
			'connected_type' => 'parent_page',
			'connected_items' => get_the_ID(),
		));
		while($parent_query->have_posts()){
			$parent_query->the_post();
			sfhiv_draw_page_navigation(get_the_ID());
		}
		wp_reset_postdata();
	}
}

add_action('get_footer','sfhiv_page_meta',200);
function sfhiv_page_meta(){
	if(is_singular()){
		get_template_part('meta-data',get_post_type());
	}
}

?>