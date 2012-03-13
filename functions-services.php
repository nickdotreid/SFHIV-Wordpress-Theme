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
		)
	);
	add_post_type_support( 'service', 'excerpt' );
}

?>