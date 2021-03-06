<?
if(!isset($show_contact_info)) $show_contact_info = false;
$profile_url = get_the_author_meta('sfhiv_website',$user->ID);
?>
<article id="user-<?=$user->ID;?>" class="member <?if($show_phone || $show_email) echo "has_contact";?>">
	<section class="profile">
		<span class="info name">
			<? if($profile_url) echo '<a href="'.$profile_url.'">';	?>
			<?=get_the_author_meta('user_firstname',$user->ID);?> <?=get_the_author_meta('user_lastname',$user->ID);?> <span class="suffix"><?=get_the_author_meta('sfhiv_suffix',$user->ID);?></span>
			<? if($profile_url) echo '</a>';	?>
		</span>
		<?	if(!p2p_get_meta( $user->p2p_id, 'hide', true )):	?>
		<?	if(p2p_get_meta( $user->p2p_id, 'title', true )):	?>
		<span class="info title"><?=p2p_get_meta( $user->p2p_id, 'title', true );?></span>
		<?	elseif(get_the_author_meta('sfhiv_title',$user->ID)): ?>
		<span class="info title"><?=get_the_author_meta('sfhiv_title',$user->ID);?></span>
		<?	endif;	?>
		<?	if(get_the_author_meta('sfhiv_department',$user->ID)):	?>
		<span class="info department"><?=get_the_author_meta('sfhiv_department',$user->ID);?></span>
		<?	endif;	?>
		<?	endif;	?>
	</section>
	<?	if($show_contact_info || p2p_get_meta( $user->p2p_id, 'show_contact_info', true )):	?>
	<section class="contact">
		<?	if(get_the_author_meta('sfhiv_telephone',$user->ID)):	?>
		<span class="info phone"><i></i> <?=get_the_author_meta('sfhiv_telephone',$user->ID);?></span>
		<?	endif;	?>
		<?	if(get_the_author_meta('email',$user->ID)):	?>
		<a href="mailto:<?=get_the_author_meta('email',$user->ID);?>" class="info email"><i></i> <?=get_the_author_meta('email',$user->ID);?></a>
		<?	endif;	?>
	</section>
	<?	endif;	?>
	<nav class="nav-author">
		<?	if($profile_url):	?>
		<a href="<?=$profile_url;?>"><?_e("View Profile");?></a>
		<?	endif;	?>
		<?	if(is_user_logged_in() && 
				(current_user_can( 'edit_users' ) || get_current_user_id()==$user->ID)):	?>
			<a href="/wp-admin/user-edit.php?user_id=<?=$user->ID;?>"><?_e("Edit Profile",'sfhiv_theme');?></a>
		<?	endif;	?>
	</nav>
	<br class="clear" />
</article>