<aside class="contact list">
	<p><?=p2p_get_meta( $user->p2p_id, 'subject', true );?></p>
	<?	$show_contact_info = true;	?>
	<?	include(locate_template('list-member.php'));	?>
</aside>
