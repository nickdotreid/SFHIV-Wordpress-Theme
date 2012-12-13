<li id="post-<?=the_ID();?>" <?php post_class("list-item"); ?>>
	<?= sfhiv_format_document(wp_get_attachment_url(),get_the_title()); ?>
</li>