<?php

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'header-size', 950, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'featured-size', 450, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'homepage-size', 9999, 350 );
	add_image_size( 'sidebar', 200, 9999);
	
	add_image_size( 'thumbnail', 100, 100, true);
}

?>