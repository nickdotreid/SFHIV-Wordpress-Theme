<?php

add_action('short_after_content','sfhiv_list_list_attachments',5);
function sfhiv_list_list_attachments(){
	global $post;
	$attachments = new WP_Query(array(
		'post_status' => 'any',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'nopaging' => true,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_mime_type' => 'application'
		) );
	if($attachments->post_count < 1) return;
	$original_post = get_post();
	echo '<ul class="attachments">';
	while($attachments->have_posts()){
		$attachments->the_post();
		get_template_part('list-item',get_post_type());
	}
	echo '</ul>';
	setup_postdata($post);
	$post = $original_post;
}

?>