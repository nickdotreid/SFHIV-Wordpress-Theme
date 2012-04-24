<article id="post-<?=the_ID();?>" <?php post_class("list-item mime-".sanitize_title(get_post_mime_type())); ?>>
	<header>
		<h3 class="entry-title"><a href="<?=wp_get_attachment_url();?>"><?=the_title();?></a></h3>
	</header>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<nav>
		<a href="<?=wp_get_attachment_url();?>">Download <?=the_title();?></a>
	</nav>
</article>