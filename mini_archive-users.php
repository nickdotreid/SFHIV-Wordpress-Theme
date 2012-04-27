<section id="members" class="list">
	<?
	sfhiv_users_sort_by_name($users);
	foreach($users as $user):
		include(locate_template('list-member.php'));
	endforeach;
	?>
</section>