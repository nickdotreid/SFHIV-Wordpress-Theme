<?php
/**
 * The template used for displaying page content in preview loops
 *
 */

$background_image = false;
if ( has_post_thumbnail() ) {
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), "homepage-size" );
	if($thumbnail){
		$background_image = $thumbnail[0];
	}
}
?>
<a href="<? the_permalink(); ?>">
	<div class="slider-image" <?	if($background_image) echo 'style="background-image:url('.$background_image.');"';?> ></div>
</a>
<div class="slider-item-container">
	<div id="post-<?php the_ID(); ?>" <?php post_class("featured slider-item"); ?> >
		<header class="entry-header">
			<h3 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<? the_excerpt(); ?>
		</div><!-- .entry-content -->
		<div class="entry-nav">
		<?	do_action("sfhiv-preview-menu");	?>
		</div>
	</div><!-- #post-<?php the_ID(); ?> -->
</div>