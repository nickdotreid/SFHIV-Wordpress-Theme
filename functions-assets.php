<?

add_action('wp_head','sfhiv_custom_meta',10);
add_action('wp_head','sfhiv_add_styles',15);
add_action('wp_head','sfhiv_add_scripts',16);

function sfhiv_custom_meta(){
	?>
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<?
}

add_action( 'wp_enqueue_scripts', 'sfhiv_enriqueue_styles', 15 );
function sfhiv_enriqueue_styles() {
	$base_dir = get_bloginfo('stylesheet_directory')."/assets/css/";
	wp_enqueue_style( 'sfhiv_base', $base_dir.'sfhiv_styles.css');
	wp_enqueue_style( 'sfhiv_layout', $base_dir.'layout.css');
	wp_enqueue_style( 'sfhiv_module_search', $base_dir.'search.css');
}

function sfhiv_add_styles(){
	?>
	<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/normalize.css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/menu.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/member.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/event.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/service.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/attachment.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/slider.css" />
	<?
}

function sfhiv_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/modernizr.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/page.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/events.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/years.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/faq.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/slider.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/Respond/respond.min.js"></script>
	<?
}

?>