<?php

function sfhiv_page_menu_args( $args ) {
	$args['show_home'] = false;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sfhiv_page_menu_args', 50 );

add_action( 'widgets_init', 'sfhiv_register_sidebars',11 );
function sfhiv_register_sidebars(){
	register_sidebar(array(
		'name' => 'Bottom Sidebar',
		'id' => 'bottom-sidebar',
		'description' => 'widgets here will be displayed at the bottom of the page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Home Page',
		'id' => 'home-widgets',
		'description' => 'widgets here will be shown on the home page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Home Page Slider',
		'id' => 'home-slider-widgets',
		'description' => 'widgets here will be as slider widgets',
		'before_widget' => '<div id="%1$s" class="item widget %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3 class="title widgettitle">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog-widgets',
		'description' => 'widgets here will be shown next to the blog',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
	));
}

add_action('init', 'sfhiv_register_custom_menu');
function sfhiv_register_custom_menu() {
	register_nav_menu('footer_menu', 'Footer Menu');
	register_nav_menu('admin_menu', 'Admin Menu');
}

add_action('get_sidebar','sfhiv_add_blog_sidebar',15);
function sfhiv_add_blog_sidebar(){
	if(is_home() || (is_singular() && get_post_type() == "post")):
	?>
	<?dynamic_sidebar("Blog Sidebar");?>
	<?
	endif;
}

add_action('get_footer','sfhiv_add_home_page_widgets',5);
function sfhiv_add_home_page_widgets(){
	if(!is_front_page()) return;
	?>
	<div class="divider"></div>
	<section id="home_page_widgets" class="three-column">
		<?dynamic_sidebar("Home Page");?>
		<br class="clear" />
	</section>

	<?
}

?>