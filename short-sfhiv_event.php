<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>><?	if(get_post_meta(get_the_ID(),'sfhiv_event_unique_page_checkbox',true)):	?>
	<header>
		<h3 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	</header><?	endif;	?>
	<?	do_action("short_before_content");	?>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<?	do_action("short_after_content");	?>
	<nav class="entry-navigation">
		<?	do_action("short_navigation");	?>
		<br class="clear" />
	</nav>
</article>