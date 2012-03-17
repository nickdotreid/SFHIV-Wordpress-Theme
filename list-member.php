<article class="member">
	<span class="avatar"><?	userphoto_thumbnail($user);	?></span>
	<span class="info name"><?=get_the_author_meta('display_name',$user->ID);?></span>
	<?	if(p2p_get_meta( $user->p2p_id, 'title', true )):	?>
	<span class="info title"><?=p2p_get_meta( $user->p2p_id, 'title', true );?></span>
	<?	endif;	?>
	<span class="info title"><?=get_the_author_meta('title',$user->ID);?></span>
	<span class="info phone_number"><?=get_the_author_meta('phone_number',$user->ID);?></span>
	<?	if(get_the_author_meta('email',$user->ID)):	?>
	<span class="info email"><span class="label">Email:</span> <a href="mailto:<?=get_the_author_meta('email',$user->ID);?>"><?=get_the_author_meta('email',$user->ID);?></a></span>
	<?	endif;	?>
</article>