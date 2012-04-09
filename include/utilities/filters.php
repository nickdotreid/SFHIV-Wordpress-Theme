<?php

function sfhiv_draw_filters($filter_key,$options=array(),$all_text="All",$legend_text="",$button_text="Update"){
		?>
		<nav>
			<ul class="filters menu">
				<li class="cat-item "><a href="<?=remove_query_arg($filter_key);?>"><?_e($all_text);?></a></li>
				<?	foreach($options as $option):	?>
				<li class="cat-item <?
					if($_GET[$filter_key] == $option['value'] ||
							($option['default'] && !isset($_GET['filter_key']))) echo 'current-item"';
				?>">
					<a href="<?=add_query_arg($filter_key,$option['value']);?>"><?=$option['name'];?></a>
				</li>
				<?	endforeach;	?>
			</ul>
		</nav>
		<?
}


?>