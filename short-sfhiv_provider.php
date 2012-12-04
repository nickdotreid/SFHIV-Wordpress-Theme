<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title provider-title"><?=the_title();?></h3>
	</header>
	<?	do_action("short_after_content");	?>
	<div class="clear"></div>
</article>