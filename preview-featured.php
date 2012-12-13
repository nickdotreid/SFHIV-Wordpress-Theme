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
<div id="post-<?php the_ID(); ?>" <?php post_class("featured slider-item"); ?> >
	<a href="<? the_permalink(); ?>">
		<div class="slider-image" <?	if($background_image) echo 'style="background-image:url('.$background_image.');"';?> ></div>
	</a>
	<h3 class="entry-title title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<? the_excerpt(); ?>
</div><!-- #post-<?php the_ID(); ?> -->
