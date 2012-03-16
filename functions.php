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
		'name' => 'contact_user',
		'from' => array(
			'sfhiv_group',
			'event',
			'page',
			'post'
		),
		'to' => 'user'
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

?>