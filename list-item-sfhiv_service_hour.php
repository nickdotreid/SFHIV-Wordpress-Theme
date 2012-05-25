<li id="post-<?=the_ID();?>" <?php 
	post_class("list-item");
	do_action("list-item");
	?>>
	<?	do_action('before_list-item');	?>
	<?	do_action('after_list-item');	?>
</li>