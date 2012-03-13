<?php

include_once('functions-menus.php');

include_once('functions-assets.php');
include_once('functions-pages.php');
include_once('functions-events.php');

include_once('functions-groups.php');

include_once('functions-years.php');

include_once('functions-contact-user.php');

add_action( 'init', 'sfhiv_create_group_type' );
function sfhiv_create_group_type() {
	register_post_type( 'group',
		array(
			'labels' => array(
				'name' => __( 'Groups' ),
				'singular_name' => __( 'Group' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	add_post_type_support( 'group', 'excerpt' );
}

add_action( 'init', 'sfhiv_create_group_categories' );
function sfhiv_create_group_categories() {
 $labels = array(
    'name' => _x( 'Group Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Group Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Group Categories' ),
    'all_items' => __( 'All Group Categories' ),
    'parent_item' => __( 'Parent Group Category' ),
    'parent_item_colon' => __( 'Parent Group Category:' ),
    'edit_item' => __( 'Edit Group Category' ),
    'update_item' => __( 'Update Group Category' ),
    'add_new_item' => __( 'Add New Group Category' ),
    'new_item_name' => __( 'New Group Category Name' ),
  ); 	

  register_taxonomy('group_category',array('group','event','report'),array(
    'hierarchical' => true,
    'labels' => $labels,
  ));
}

add_action( 'init', 'sfhiv_create_years' );
function sfhiv_create_years() {
 $labels = array(
    'name' => _x( 'Years', 'taxonomy general name' ),
    'singular_name' => _x( 'Year', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Years' ),
    'all_items' => __( 'All Years' ),
    'edit_item' => __( 'Edit Year' ),
    'update_item' => __( 'Update Year' ),
    'add_new_item' => __( 'Add New Year' ),
    'new_item_name' => __( 'New Year Name' ),
  ); 	

  register_taxonomy('year',array('group','event','report'),array(
    'hierarchical' => true,
    'labels' => $labels
  ));
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

add_action('init','sfhiv_add_reports_type');
function sfhiv_add_reports_type(){
	register_post_type( 'report',
		array(
			'labels' => array(
				'name' => __( 'Report' ),
				'singular_name' => __( 'Report' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	add_post_type_support( 'report', 'excerpt' );
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