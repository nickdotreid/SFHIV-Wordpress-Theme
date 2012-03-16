<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?>>
	<header>
		<h1><?=the_title();?></h1>
	</header>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>">Read More</a>
	</nav>
</article>