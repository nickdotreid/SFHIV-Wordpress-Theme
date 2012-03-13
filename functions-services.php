<?php

add_action('init','sfhiv_add_services_type');
function sfhiv_add_services_type(){
	register_post_type( 'service',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Service' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'taxonomies' => array('catagories'),
		'register_meta_box_cb' => 'sfhiv_add_services_meta_boxes',
		)
	);
	add_post_type_support( 'service', 'excerpt' );
}

function sfhiv_add_services_meta_boxes(){
	add_meta_box( 'sfhiv_services_hours', 'Hours of Operation', 'sfhiv_services_hours_op_meta', 'service', 'normal' );
}

function sfhiv_services_hours_op_meta($post){
	
}

?>