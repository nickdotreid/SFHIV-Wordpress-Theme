<li id="post-<?=the_ID();?>" <?php 
	post_class("list-item");
	do_action("list-item");
	?>>
	<a href="<?=the_permalink();?>">
		<?	do_action('before_list-item');	?>
		<?=the_title();?>
		<?	do_action('after_list-item');	?>
	</a>
</li>