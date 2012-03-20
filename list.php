<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?>>
	<header>
		<h1 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>">Read More</a>
	</nav>
</article>