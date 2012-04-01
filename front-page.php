<?php get_header(); ?>
<?
$related = new WP_Query( array(
  'connected_type' => 'related_pages',
  'connected_items' => get_the_ID(),
  'nopaging' => true,
) );
if($related->post_count > 0):
?>
		<section id="featured" class="slider">
<?	while($related->have_posts()):	?>
	<?	$related->the_post();	?>
	<?	get_template_part('featured',get_post_type());	?>
<?	endwhile;	?>
		</section>
<?	wp_reset_postdata();
	endif;	?>
		<div id="primary">
			<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_type() ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>