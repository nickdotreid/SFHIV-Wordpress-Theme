<?php

add_shortcode('post_preview','sfhiv_preview_shortcode');
function sfhiv_preview_shortcode($atts, $content = null){
	global $post;
	
	extract( shortcode_atts( array(
		'id' => false,
		'title' => false,
		'replace_title' => false,
		'replace_content' => false,
		'template' => 'preview',
	), $atts ) );
	
	$preview_post = false;
	$return_content = "";
	if(isset($title)){
		
	}
	if(isset($id) && !$preview_post){
		$num = (int) $id;
		$preview_post = get_post($num);
	}
	if($preview_post){
		$org_post = $post;
		$post = $preview_post;
		if($replace_title) $post->post_title = $replace_title;
		if($content != null){
			$post->post_content = $content;
			$post->post_excerpt = $content;
		}
		if($replace_content){
			$post->post_content = $replace_content;
			$post->post_excerpt = $replace_content;
		}
		ob_start();
		get_template_part($template,$post->post_type);
		$return_content = ob_get_clean();
		$post = $org_post;
	}
	
	return $return_content;
}


?>