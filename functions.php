<?php

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

include_once('include/document-page.php');
include_once('include/document-archive.php');

include_once('functions-images.php');


include_once('widget-preview-page.php');

include_once('editor_styles.php');

include_once('preview-shortcode.php');
include_once('document-shortcode.php');

include_once('include/table_of_contents.php');

include_once('functions-top-image.php');
include_once('functions_service_hour_switch.php');

add_action('init','sfhiv_add_excerpt_to_page');
function sfhiv_add_excerpt_to_page(){
	add_post_type_support( 'page', 'excerpt' );
}

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
		"show_empty" => false,
		"wrap_before" => false,
		"wrap_after" => false,
	),$args);
	$args = apply_filters('sfhiv_loop_arguments',$args,$query->query_vars['post_type']);
	if($query->post_count<1 && !$args['show_empty']) return;
	echo '<'.$args['container'].' id="'.$args['id'].'" class="'.implode(" ",$args['classes']).'">';
	if($args['show_filters']) do_action("sfhiv_pre_loop",$query,array_merge($args,array("extra_classes" => 'top')));
	if(isset($args['title']) && $args['title']!=""){
		echo '<h2 class="list-title">'.$args['title'].'</h2>';
	}
	echo $args['wrap_before'];
	$query = apply_filters('sfhiv_loop_pre_display',$query);
	while($query->have_posts()){
		$query->the_post();
		get_template_part( $args['list_element'], get_post_type() );
	}
	wp_reset_postdata();
	echo $args['wrap_after'];
	if($args['show_filters']) do_action("sfhiv_post_loop",$query,array_merge($args,array("extra_classes" => 'bottom')));
	echo '</'.$args['container'].'><!-- #'.$args['id'].'-->';
}

?>