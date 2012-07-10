<?php get_header(); ?>
		<section id="featured" class="slider jcarousel-skin-tango">
			<ul>
				<li>
					<?	// get_template_part('featured',get_post_type());	?>
				</li>
			</ul>
		</section>
<?	wp_reset_postdata();
	endif;	?>
<?php get_footer(); ?>