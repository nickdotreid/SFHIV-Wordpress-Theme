<?php

require_once('models/models.php');
require_once('include/utilities/utilities.php');

include_once('functions-menus.php');

include_once('functions-assets.php');

include_once('include/page-page.php');
include_once('include/page-preview.php');

include_once('include/common-page.php');

include_once('include/event-functions.php');

include_once('include/group-functions.php');
include_once('include/group-archive.php');
include_once('include/group-page.php');

include_once('include/service-archive.php');

include_once('include/report-archive.php');

include_once('include/years-archive.php');
include_once('functions-services.php');
include_once('include/contact-user.php');

include_once('include/document-page.php');

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
			'post',
			'sfhiv_training',
			'sfhiv_document',
			'sfhiv_report',
		),
		'to' => 'user',
		'fields' => array(
				'subject' => 'Subject',
				),
	) );
}
add_action( 'wp_loaded', 'sfhiv_connection_types' );

add_action('get_sidebar','sfhiv_group_sidebar_start',10);
function sfhiv_group_sidebar_start(){
	echo '<div class="sidebar">';
}
add_action('get_sidebar','sfhiv_group_sidebar_end',100);
function sfhiv_group_sidebar_end(){
	echo '</div><!-- .sidebar -->';
}

?>