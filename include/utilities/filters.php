<?php

function sfhiv_draw_filters($filter_key,$options=array(),$all_text="All",$legend_text="",$button_text="Update"){
		?>
		<form action="" method="get" class="filter">
			<?	foreach($_GET as $key=>$value):	?>
				<?	if($key != $filter_key):	?>
				<input type="hidden" name="<?=$key;?>" value="<?=$value;?>" />
				<?	endif;	?>
			<?	endforeach;	?>
			<fieldset>
				<?	if($legend_text != ""):	?>
				<legend><?_e($legend_text);?></legend>
				<?	endif;	?>
				<label class="radio">
					<input type="radio" name="<?=$filter_key;?>" value="" <?	
					if(!isset($_GET[$filter_key]) || $_GET[$filter_key]!="")	echo 'checked="checked"';
					?> />
					<?_e($all_text);?>
				</label>
				<?	foreach($options as $option):	?>
				<label class="radio">
					<input type="radio"	name="<?=$filter_key;?>" <?	
					if($_GET[$filter_key] == $option['value'] ||
							($option['default'] && !isset($_GET['filter_key']))) echo 'checked="checked"';	
							?>value="<?=$option['value'];?>" />
					<?=$option['name'];?>
				</label>
				<?	endforeach;	?>
			</fieldset>
			<input type="submit" class="button submit" value="<?_e($button_text);?>" />
		</form>
		<?
}


?>