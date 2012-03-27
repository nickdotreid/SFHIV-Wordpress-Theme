<article id="post-<?=the_ID();?>" <?php post_class("list-item mime-".sanitize_title(get_post_mime_type())); ?>>
	<header>
		<h1 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<nav>
		<a href="<?=wp_get_attachment_url();?>">Download</a>
	</nav>
</article>