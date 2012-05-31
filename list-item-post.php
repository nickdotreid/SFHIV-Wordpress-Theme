<li id="post-<?=the_ID();?>" <?php 
	post_class("list-item");
	do_action("list-item");
	?>>
	<?	do_action('before_list-item');	?>
	<a href="<?=the_permalink();?>">
		<span class="title"><?=the_title();?></span>
	</a>
	<span class="date date-post"><?=get_the_date();?></span>
	<?	do_action('after_list-item');	?>
</li>