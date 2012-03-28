<?php

function sfhiv_draw_filters($filter_key,$options=array(),$all_text="All",$button_text="Update",$legend_text=""){
		?>
		<form action="" method="get" class="filter">
			<?	foreach($_GET as $key=>$value):	?>
				<?	if($key != $filter_key):	?>
				<input type="hidden" name="<?=$key;?>" value="<?=$value;?>" />
				<?	endif;	?>
			<?	endforeach;	?>
			<?	if(isset($_GET[$filter_key]) && $_GET[$filter_key]!=""):	?>
			<label class="radio">
				<input type="radio" name="<?=$filter_key;?>" value="" />
				<?_e($all_text);?>
			</label>
			<?	endif;	?>
			<?	foreach($options as $option):	?>
			<label class="radio">
				<input type="radio"
					name="<?=$filter_key;?>" 
					<?	if($_GET[$filter_key] == $option['value']) echo 'checked="checked"';	?>
					value="<?=$option['value'];?>" />
				<?=$option['name'];?>
			</label>
			<?	endforeach;	?>
			<input type="submit" class="button submit" value="<?_e($button_text);?>" />
		</form>
		<?
}


?>