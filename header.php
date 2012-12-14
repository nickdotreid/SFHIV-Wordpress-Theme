<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = preg_replace('/\/n/',' ',get_bloginfo( 'description', 'display' ));
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/assets/i/favicon.ico" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
	<header id="branding" class="container <?=apply_filters("header-class","");?>" role="banner" style="<?=apply_filters("header-styles","");?>">
		<div class="inner header-inner">
			<hgroup class="brand-container">
				<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php echo preg_replace('/\/n/','<br />',get_bloginfo( 'description', 'raw' )); ?></h2>
				<div class="clear"></div>
			</hgroup>
			<?php do_action('before_access');	?>
			<nav id="access" class="menu-justified" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>
				<div class="menu-item menu-item-home <? if(is_front_page()) echo "current-menu-item"; ?>">
					<a href="<?php echo home_url( '/' ); ?>"><i></i>Home</a>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<div class="menu-item search-form-item">
					<?php get_search_form(); ?>
				</div>
				<div class="clear"></div>
			</nav><!-- #access -->
			<?php do_action('after_access');	?>
			<div class="divider divider-flush" style="padding-top:16px;background-position:bottom center;"></div>
			<div class="clear">&nbsp;</div>
		</div>
	</header><!-- #branding -->
	<?	if(is_singular() && get_post_status() != "publish"):	?>
	<div id="status-warning" class="container <?=get_post_status();?>">
		<span><i></i>This item is marked <?=get_post_status();?>.</span>
		<div class="divider divider-flush"></div>
	</div>
	<?	endif;	?>
	<?php do_action('after_header');	?>
	<div id="main" class="container">