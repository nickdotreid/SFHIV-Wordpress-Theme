<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	</header>
	<div class="info-service">
		<?	do_action("short_before_content");	?>
		<br class="clear" />
	</div>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<?	do_action("short_after_content");	?>
	<nav class="entry-navigation">
		<?	do_action("short_navigation");	?>
		<br class="clear" />
	</nav>
	<br class="clear" />
</article>