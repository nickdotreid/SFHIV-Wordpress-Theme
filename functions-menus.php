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
		'name' => 'Top Sidebar',
		'id' => 'top-sidebar',
		'description' => 'widgets here will be displayed at the top of the page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));
}

add_action('init', 'sfhiv_register_custom_menu');
function sfhiv_register_custom_menu() {
	register_nav_menu('footer_menu', 'Footer Menu');
}

add_action('before','sfhiv_add_top_sidebar',40);
function sfhiv_add_top_sidebar(){
	?>
	<section id="section-top" class="content top">
		<?dynamic_sidebar("Top Sidebar");?>
	</section>

	<?
}

add_action('get_footer','sfhiv_add_bottom_sidebar',40);
function sfhiv_add_bottom_sidebar(){
	?>
	<section class="footer bottom three-column">
		<?dynamic_sidebar("Bottom Sidebar");?>
		<br class="clear" />
	</section>

	<?
}

add_action('get_footer','sfhiv_add_footer_menu',39);
function sfhiv_add_footer_menu(){
	wp_nav_menu(array(
		'theme_location' => 'footer_menu',
		'container' => 'nav',
		'container_class' => 'footer',
		'depth'=>1,
		));	
}

?>