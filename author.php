<?
$user = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

$show_bio = get_the_author_meta('sfhiv_show_bio',$author);
if(!$show_bio){
	header( 'Location: /' );
}
?>
<?php get_header(); ?>
<?	if(userphoto_exists($user)):	?>
<div class="sidebar photo">
<?	userphoto($user);	?>
</div>
<?	endif;	?>
<div id="primary">
	<div id="content" role="main">
			<article id="user-<?=$author;?>" class="member">
				<header>
					<h1 class="entry-title"><?=get_the_author_meta('user_firstname',$author);?> <?=get_the_author_meta('user_lastname',$author);?></h1>
				</header>
				<div class="entry-content">
					<?=$user->description;?>
				</div>
		</article><!-- #archive -->
	</div><!-- #content -->
</div><!--	#primary -->
<section class="sidebar contact">
	<?	if(get_the_author_meta('sfhiv_telephone',$user->ID)):	?>
	<span class="info phone"><span class="label">Phone:</span> <?=get_the_author_meta('sfhiv_telephone',$user->ID);?></span>
	<?	endif;	?>
	<?	if(get_the_author_meta('email',$user->ID)):	?>
	<span class="info email"><span class="label">Email:</span> <a href="mailto:<?=get_the_author_meta('email',$user->ID);?>"><?=get_the_author_meta('email',$user->ID);?></a></span>
	<?	endif;	?>
</section>
<?php get_footer(); ?>