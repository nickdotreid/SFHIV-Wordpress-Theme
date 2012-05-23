<li id="post-<?=the_ID();?>" <?php post_class("list-item mime-".sanitize_title(get_post_mime_type())); ?>>
	<a href="<?=wp_get_attachment_url();?>"><i class="attachment"></i><?=the_title();?></a>
	<span class="description">
		<span><?=get_post_mime_type();?></span>
	</span>
</li>