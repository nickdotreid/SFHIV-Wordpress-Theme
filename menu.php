<nav><ul class="menu">
<?
while($wp_query->have_posts()):
	$wp_query->the_post();
	get_template_part('menu-item',get_post_type());
endwhile;
?>
</ul></nav>