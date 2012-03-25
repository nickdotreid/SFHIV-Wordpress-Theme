<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	<? do_action('before_content');	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<? do_action('after_content');	?>
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->