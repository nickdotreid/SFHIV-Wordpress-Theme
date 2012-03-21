<?php

add_action('get_sidebar','sfhiv_report_page_back_to_index',20);
function sfhiv_report_page_back_to_index(){
	if(is_singular('sfhiv_report')){
		?>
		<nav>
			<ul class="menu">
				<li><a href="<?=get_post_type_archive_link('sfhiv_report');?>"><?_e("All Reports");?></a></li>
			</ul>
		</nav>
		<?
	}
}

add_action('get_sidebar','sfhiv_add_report_navigation',22);
function sfhiv_add_report_navigation(){
	if(is_singular('sfhiv_report')){
		sfhiv_draw_page_navigation(get_the_ID());
	}
}
?>