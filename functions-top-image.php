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


?>