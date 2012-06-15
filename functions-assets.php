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
	wp_enqueue_style( 'sfhiv_styles', $base_dir.'sfhiv_styles.css');
}

function sfhiv_add_styles(){
	?>
	<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
	<?
	$base_dir = get_bloginfo('stylesheet_directory')."/assets/css/";
	?><link href='<?=$base_dir.'print.css';?>' media="print" rel='stylesheet' type='text/css'><?	
}

function sfhiv_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/modernizr.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/page.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/faq.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/slider.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/Respond/respond.min.js"></script>
	<?
}

?>