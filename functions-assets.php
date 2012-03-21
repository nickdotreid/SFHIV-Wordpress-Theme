<?

add_action('wp_head','sfhiv_add_styles',15);
add_action('wp_head','sfhiv_add_scripts',16);

function sfhiv_add_styles(){
	?>
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/normalize.css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/sfhiv_styles.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/menu.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/member.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/event.css" />
	<link rel="stylesheet" type="text/css" href="<?=get_bloginfo('stylesheet_directory');?>/assets/css/service.css" />
	<?
}

function sfhiv_add_scripts(){
	?>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/modernizr.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/page.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/events.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/assets/js/years.js"></script>
	<script type="text/javascript" src="<?=get_bloginfo('stylesheet_directory');?>/Respond/respond.min.js"></script>
	<?
}

?>