<article id="post-<?=the_ID();?>" <?php 
	post_class("list-item");
	do_action("list_attributes");
	?>>
	<header>
		<h3 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	</header>
	<?	do_action("list_before_content");	?>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<?	do_action("list_after_content");	?>
	<nav>
		<?	do_action("list_navigation");	?>
		<a href="<?=the_permalink();?>">Read More</a>
	</nav>
</article>