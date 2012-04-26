<section id="members" class="list">
	<?
	usort($users,function($a,$b){
		if(get_the_author_meta('user_lastname',$a->ID) > get_the_author_meta('user_lastname',$b->ID)){
			return 1;
		}
		if(get_the_author_meta('user_lastname',$a->ID) < get_the_author_meta('user_lastname',$b->ID)){
			return -1;
		}
		if(get_the_author_meta('user_firstname',$a->ID) > get_the_author_meta('user_firstname',$b->ID)){
			return 1;
		}
		if(get_the_author_meta('user_firstname',$a->ID) < get_the_author_meta('user_firstname',$b->ID)){
			return -1;
		}
		return 0;
	});
	foreach($users as $user):
		include(locate_template('list-member.php'));
	endforeach;
	?>
</section>