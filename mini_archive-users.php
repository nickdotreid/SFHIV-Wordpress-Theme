<section id="members" class="list">
	<?
	foreach($users as $user):
		include(locate_template('list-member.php'));
	endforeach;
	?>
</section>