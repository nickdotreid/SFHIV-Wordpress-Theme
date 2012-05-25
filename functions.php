<?php

require_once('models/models.php');
require_once('include/utilities/utilities.php');

include_once('functions-menus.php');

include_once('functions-assets.php');

include_once('include/post-page.php');

include_once('include/page-page.php');
include_once('include/page-preview.php');

include_once('include/common-list.php');
include_once('include/common-page.php');
include_once('include/common-archive.php');

include_once('include/location-functions.php');

include_once('include/event-functions.php');

include_once('include/group-functions.php');
include_once('include/group-archive.php');
include_once('include/group-page.php');

include_once('include/event-page.php');
include_once('include/event-archive.php');

include_once('include/service-page.php');
include_once('include/service-archive.php');

include_once('include/report-page.php');
include_once('include/report-archive.php');

include_once('include/study-page.php');

include_once('include/years-archive.php');
include_once('include/contact-user.php');

include_once('include/document-page.php');
include_once('include/document-archive.php');

include_once('functions-images.php');


include_once('widget-preview-page.php');



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
			'sfhiv_event',
			'page',
			'post',
			'sfhiv_training',
			'sfhiv_document',
		),
		'to' => 'user',
		'fields' => array(
				'subject' => 'Subject',
				),
		'title' => 'User to Contact',
		'admin_box' => array(
			'show' => 'from',
			'context' => 'advanced',
		),
		'sortable' => true,
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

add_action('sfhiv_loop','sfhiv_loop_items',10, 2);
function sfhiv_loop_items($query=false,$args=array()){
	if(!$query) return;
	$query = apply_filters('sfhiv_loop_filter_query',$query);
	$args = array_merge(array(
		"id" => "archive",
		"container" => "section",
		"classes" => array("list"),
		"list_element" => "short",
		"show_filters" => true,
	),$args);
	$args = apply_filters('sfhiv_loop_arguments',$args,$query->query_vars['post_type']);
	if($query->post_count<1 && !$args['show_empty']) return;
	echo '<'.$args['container'].' id="'.$args['id'].'" class="'.implode(" ",$args['classes']).'">';
	if($args['show_filters']) do_action("sfhiv_pre_loop",$query,$args);
	if(isset($args['title']) && $args['title']!=""){
		echo '<h2 class="list-title">'.$args['title'].'</h2>';
	}
	echo $args['wrap_before'];
	while($query->have_posts()){
		$query->the_post();
		get_template_part( $args['list_element'], get_post_type() );
	}
	wp_reset_postdata();
	echo $args['wrap_after'];
	if($args['show_filters']) do_action("sfhiv_post_loop",$query,$args);
	echo '</'.$args['container'].'><!-- #'.$args['id'].'-->';
}

?>