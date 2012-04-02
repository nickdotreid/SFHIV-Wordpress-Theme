<?php

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'featured-size', 450, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'homepage-size', 520, 350, true ); //(cropped)
}

?>