<li class="<?	if(get_the_ID() == $post->ID) echo 'current-page-item';	?>">
	<a href="<?the_permalink($post->ID);?>" class="menu-item" group-id="<?the_ID($post->ID);?>" slug="<?=$post->post_name;?>" ><?=$post->post_title;?></a>
</li>