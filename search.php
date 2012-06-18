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
		</div>
		<section id="primary">
			<?php if ( have_posts() ) : ?>
			<div id="content" role="main" class="list">
				<header>
					<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php do_action("sfhiv_pre_loop"); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'short', get_post_type() ); ?>
				<?php endwhile; ?>
				<?php do_action("sfhiv_post_loop"); ?>
			</div>
			<?php else : ?>
			<div id="content" role="main" class="list">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'toolbox' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
			</div>
			<?php endif; ?>
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>