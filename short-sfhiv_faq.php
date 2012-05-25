<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><a href="#"><?=the_title();?></a></h3>
	</header>
	<?	do_action("short_before_content");	?>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<?	do_action("short_after_content");	?>
	<nav class="entry-navigation">
		<a href="#" class="open" style="display:none;"><?_e("View")?></a>
		<a href="#" class="close" style="display:none;"><?_e("Close")?></a>
		<?	do_action("short_navigation");	?>
		<br class="clear" />
	</nav>
</article>