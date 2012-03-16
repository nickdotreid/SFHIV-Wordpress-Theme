<?php

require_once('models/models.php');

include_once('functions-menus.php');

include_once('functions-assets.php');
include_once('functions-pages.php');
include_once('functions-events.php');

include_once('functions-groups.php');

include_once('functions-years.php');
include_once('functions-services.php');
include_once('functions-contact-user.php');

add_action('init','sfhiv_add_excerpt_to_page');
function sfhiv_add_excerpt_to_page(){
	add_post_type_support( 'page', 'excerpt' );
}

function sfhiv_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'group_members',
		'from' => 'group',
		'to' => 'user',
		'fields' => array(
				'title' => 'Title',
				'incomplete' => array(
					'title' => 'Incomplete',
					'type' => 'checkbox'
				),
			)
	) );
	
	p2p_register_connection_type( array(
		'name' => 'contact_user',
		'from' => array('group','event','page','post'),
		'to' => 'user'
	) );
	
	p2p_register_connection_type( array(
		'name' => 'group_events',
		'from' => 'group',
		'to' => 'event',
	) );
	
	p2p_register_connection_type( array(
		'name' => 'group_services',
		'from' => 'group',
		'to' => 'service',
	) );
	
	p2p_register_connection_type( array(
		'name' => 'parent_page',
		'from' => array('group','event'),
		'to' => 'page',
	) );
}
add_action( 'wp_loaded', 'sfhiv_connection_types' );

add_action('get_sidebar','sfhiv_group_sidebar_start',1);
function sfhiv_group_sidebar_start(){
	echo '<div class="sidebar">';
}
add_action('get_sidebar','sfhiv_group_sidebar_end',20000);
function sfhiv_group_sidebar_end(){
	echo '</div><!-- .sidebar -->';
}

add_action( 'init', 'sfhiv_create_report_categories' );
function sfhiv_create_report_categories() {
 $labels = array(
    'name' => _x( 'Report Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Report Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Report Categories' ),
    'all_items' => __( 'All Report Categories' ),
    'parent_item' => __( 'Parent Report Category' ),
    'parent_item_colon' => __( 'Parent Report Category:' ),
    'edit_item' => __( 'Edit Report Category' ),
    'update_item' => __( 'Update Report Category' ),
    'add_new_item' => __( 'Add New Report Category' ),
    'new_item_name' => __( 'New Group Report Name' ),
  ); 	

  register_taxonomy('report_category',array('report'),array(
    'hierarchical' => true,
    'labels' => $labels,
  ));
}

?>