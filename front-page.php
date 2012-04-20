<?php get_header(); ?>
<?
$related = sfhiv_get_related_pages();
if($related->post_count > 0):
?>
		<section id="featured" class="slider jcarousel-skin-tango">
			<ul>
<?	while($related->have_posts()):
	$related->the_post();
	$background_image = false;
	if ( has_post_thumbnail() ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), "homepage-size" );
		if($thumbnail){
			$background_image = $thumbnail[0];
		}
	}
	?>
				<li <?	if($background_image) echo 'style="background-image:url('.$background_image.');"';	?>>
					<?	get_template_part('featured',get_post_type());	?>
				</li>
<?	endwhile;	?>
			</ul>
		</section>
<?	wp_reset_postdata();
	endif;	?>
<?php get_footer(); ?>