<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?>
	services="<?=implode(",",wp_get_object_terms(get_the_ID(),'sfhiv_service_categories',array("fields"=>"slugs")));?>"
	>
	<header>
		<h3 class="entry-title"><a href="<?the_permalink();?>"><?=the_title();?></a></h3>
	</header>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<nav>
		<a href="#" class="js-only open">View</a>
		<a href="#" class="js-only close">Close</a>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</nav>
</article>