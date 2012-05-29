<?php

function sfhiv_draw_filters($filter_key,$selected_value = false,$options=array(),$all_text="All",$all_value=false){
		?>
		<nav>
			<ul class="filter filter-horizontal menu">
				<li class="cat-item <?
					if($selected_value == $all_value) echo 'current_item';
				?>"><a href="<?=add_query_arg($filter_key,$all_value);?>"><?_e($all_text);?></a></li>
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