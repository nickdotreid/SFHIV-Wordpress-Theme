<article id="post-<?=the_ID();?>" <?php post_class(); ?> years="<?=implode(",",wp_get_object_terms(get_the_ID(),'year',array("fields"=>"slugs")));?>">
	<header>
		<h1><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>#members"><?=__('View Members','sfhiv_theme');?></a>
		<a href="<?=the_permalink();?>#meetings"><?=__('View Meetings','sfhiv_theme');?></a>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</nav>
</article>