<?php

add_filter('cmb_meta_boxes','sfhiv_top_image_metabox');
function sfhiv_top_image_metabox( $metaboxes ){
	$metaboxes[] = array(
		'id' => 'sfhiv_top_image_metabox',
		'title' => 'Header Image',
		'pages' => array(
			'page',
			'post',
			'sfhiv_study',
			'sfhiv_document'
			),
		'context' => 'normal',
		'priority' => 'low',
		'fields' => array(
			array(
				'id' => 'sfhiv_top_image',
				'name' => 'Image File',
				'desc' => 'Choose a file to replace the main image on this document',
				'type' => 'file',
				'save_id' => true,
				'allow' => array('attachment'),				
			)
		)
	);
	return $metaboxes;
}

add_filter('header-styles','sfhiv_top_image_style');
function sfhiv_top_image_style($styles){
	$image_id = get_post_meta(get_the_ID(),'sfhiv_top_image_id',true);
	if($image_id){
		$src = wp_get_attachment_image_src( $image_id, "header-size" );
		if($src){
			$background_image = $src[0];
			$styles .= 'background-image:url('.$background_image.');background-position:center center;';
		}
	}
	return $styles;
}


?>