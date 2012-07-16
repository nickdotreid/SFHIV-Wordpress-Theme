<?php
/**
 * Template Name: Profile Page
 * Description: A template for author bios
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sidebar' );

get_header(); ?>
		<div class="sidebar">
			<div class="profile-image">
				<img src="<?=$thumbnail[0];?>" alt="" />
			</div>
		</div>
		<div id="primary" class="full-width">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>