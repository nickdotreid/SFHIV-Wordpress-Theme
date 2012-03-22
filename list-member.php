<article class="member">
	<span class="avatar"><?	userphoto_thumbnail($user);	?></span>
	<span class="info name"><?=get_the_author_meta('display_name',$user->ID);?></span>
	<?	if(p2p_get_meta( $user->p2p_id, 'title', true )):	?>
	<span class="info title"><?=p2p_get_meta( $user->p2p_id, 'title', true );?></span>
	<?	elseif(get_the_author_meta('sfhiv_title',$user->ID)): ?>
	<span class="info title"><?=get_the_author_meta('sfhiv_title',$user->ID);?></span>
	<?	endif;	?>
	<?	if(get_the_author_meta('sfhiv_department',$user->ID)):	?>
	<span class="info department"><?=get_the_author_meta('sfhiv_department',$user->ID);?></span>
	<?	endif;	?>
	<?	if(get_the_author_meta('sfhiv_telephone',$user->ID)):	?>
	<span class="info phone"><span class="label">Phone:</span> <?=get_the_author_meta('sfhiv_telephone',$user->ID);?></span>
	<?	endif;	?>
	<?	if(get_the_author_meta('email',$user->ID)):	?>
	<span class="info email"><span class="label">Email:</span> <a href="mailto:<?=get_the_author_meta('email',$user->ID);?>"><?=get_the_author_meta('email',$user->ID);?></a></span>
	<?	endif;	?>
</article>