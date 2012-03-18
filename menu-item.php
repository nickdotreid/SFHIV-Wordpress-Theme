<li class="<?	if(get_the_ID() == $post->ID) echo 'current_item';	?>">
	<a href="<?=get_permalink($post->ID);?>" class="menu-item" slug="<?=$post->post_name;?>" ><?=get_the_title($post->ID);?></a>
</li>