<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	</header>
	<?	do_action("short_before_content");	?>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<?	do_action("short_after_content");	?>
	<nav>
		<?	do_action("short_navigation");	?>
		<a href="<?=the_permalink();?>">Read More</a>
		<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
	</nav>
</article>