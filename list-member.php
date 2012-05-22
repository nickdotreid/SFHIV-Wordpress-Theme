<?
$show_bio = get_the_author_meta('sfhiv_show_bio',$user->ID);
?>
<article id="user-<?=$user->ID;?>" class="member <?if($show_phone || $show_email) echo "has_contact";?>">
	<section class="profile">
		<span class="info name"><?=get_the_author_meta('user_firstname',$user->ID);?> <?=get_the_author_meta('user_lastname',$user->ID);?> <span class="suffix"><?=get_the_author_meta('sfhiv_suffix',$user->ID);?></span></span>
		<?	if(p2p_get_meta( $user->p2p_id, 'title', true )):	?>
		<span class="info title"><?=p2p_get_meta( $user->p2p_id, 'title', true );?></span>
		<?	elseif(get_the_author_meta('sfhiv_title',$user->ID)): ?>
		<span class="info title"><?=get_the_author_meta('sfhiv_title',$user->ID);?></span>
		<?	endif;	?>
		<?	if(get_the_author_meta('sfhiv_department',$user->ID)):	?>
		<span class="info department"><?=get_the_author_meta('sfhiv_department',$user->ID);?></span>
		<?	endif;	?>
	</section>
	<?	if($show_phone || $show_email):	?>
	<section class="contact">
		<?	if($show_phone && get_the_author_meta('sfhiv_telephone',$user->ID)):	?>
		<span class="info phone"><span class="label">Phone:</span> <?=get_the_author_meta('sfhiv_telephone',$user->ID);?></span>
		<?	endif;	?>
		<?	if($show_email && get_the_author_meta('email',$user->ID)):	?>
		<span class="info email"><span class="label">Email:</span> <a href="mailto:<?=get_the_author_meta('email',$user->ID);?>"><?=get_the_author_meta('email',$user->ID);?></a></span>
		<?	endif;	?>
	</section>
	<?	endif;	?>
	<nav class="nav-author">
		<?	if($show_bio):	?>
		<a href="<?=get_author_posts_url($user->ID);?>"><?_e("View Profile");?></a>
		<?	endif;	?>
		<?	if(is_user_logged_in() && 
				(current_user_can( 'edit_users' ) || get_current_user_id()==$user->ID)):	?>
			<a href="/wp-admin/user-edit.php?user_id=<?=$user->ID;?>"><?_e("Edit Profile",'sfhiv_theme');?></a>
		<?	endif;	?>
	</nav>
	<br class="clear" />
</article>