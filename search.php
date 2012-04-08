<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<div class="sidebar">
			<?php get_search_form(); ?>
			<div class="">
				<p><?_e("Showing ".$wp_query->post_count." of ".$wp_query->found_posts.' results');?></p>
			</div>
		</div>
		<section id="primary">
			<div id="content" role="main" class="list">

			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php do_action("sfhiv_pre_loop"); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'list', get_post_type() ); ?>

				<?php endwhile; ?>

				<?php do_action("sfhiv_post_loop"); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'toolbox' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>