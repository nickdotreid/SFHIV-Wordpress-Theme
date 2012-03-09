<?php
/**
 * The template used for displaying page content in preview loops
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("preview"); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<? the_content(); ?>
	</div><!-- .entry-content -->
	<nav>
	<?
	$page_IDs = get_the_ID().",";
	$subpages = get_pages(array(
		"parent"=>get_the_ID(),
		"hierarchical" => 0,
		));
	foreach($subpages as $sp){
		$page_IDs .= ",".$sp->ID;
	}
	wp_page_menu(array( 
		'show_home' => false,
		'sort_column' => 'menu_order',
		'include' => $page_IDs,
		));
		do_action("sfhiv-preview-menu");
	?>
	</nav>
</article><!-- #post-<?php the_ID(); ?> -->