<?php

$now = time();

?>
<article id="post-<?=the_ID();?>" <?php post_class("event list-item"); ?> 
	start="<?=get_post_meta(get_the_ID(),'sfhiv_event_start',true);?>" 
	end="<?=get_post_meta(get_the_ID(),'sfhiv_event_end',true);?>"
	>
	<header>
		<h3 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	</header>
	<div class="<? if(get_post_meta(get_the_ID(),'sfhiv_event_start',true) && get_post_meta(get_the_ID(),'sfhiv_event_start',true)<$now) echo "past";	?>">
		<?=get_template_part('date','event');?>
	</div>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>"><?_e("View Event");?></a>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</nav>
</article>