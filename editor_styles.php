<?php
/**
 * Modifying this tutorial:
 * http://wp.tutsplus.com/tutorials/theme-development/adding-custom-styles-in-wordpress-tinymce-editor/
 * 
**/


//Apply styles to the visual editor
add_filter('mce_css', 'sfhiv_mcekit_editor_style');
function sfhiv_mcekit_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    $url .= get_bloginfo('stylesheet_directory') . '/assets/css' . '/tiny_styles.css';

    return $url;
}


// Add "Styles" drop-down
add_filter( 'mce_buttons_2', 'sfhiv_mce_editor_buttons' );
function sfhiv_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}


// Add styles/classes to the "Styles" drop-down
add_filter( 'tiny_mce_before_init', 'sfhiv_mce_before_init' );
function sfhiv_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Plateau',
            'block' => 'div',
            'classes' => 'plateau',
            'wrapper' => true
        ),
	    array(
	        'title' => 'Well',
	        'block' => 'div',
	        'classes' => 'well',
	        'wrapper' => true
	    ),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
?>
