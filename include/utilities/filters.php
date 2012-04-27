<?php

function sfhiv_draw_filters($filter_key,$selected_value = false,$options=array(),$all_text="All"){
		?>
		<nav>
			<ul class="filters menu">
				<li class="cat-item "><a href="<?=remove_query_arg($filter_key);?>"><?_e($all_text);?></a></li>
				<?	foreach($options as $option):	?>
				<li class="cat-item <?
					if($selected_value == $option['value'] ||
							($option['default'] && !$selected_value)) echo 'current_item"';
				?>">
					<a href="<?=add_query_arg($filter_key,$option['value']);?>"><?=$option['name'];?></a>
				</li>
				<?	endforeach;	?>
			</ul>
		</nav>
		<?
}


?>