<article id="post-<?=the_ID();?>" <?php post_class("list-item mime-".sanitize_title(get_post_mime_type())); ?>>
	<h3 class="entry-title"><a href="<?=wp_get_attachment_url();?>"><i></i><?=the_title();?></a></h3>
	<span class="description">
		<span><?=get_post_mime_type();?></span>
	</span>
	<?	if(get_the_content() != ""):	?>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<?	endif;	?>
	<div class="clear"></div>
</article>