<?php

add_action('get_sidebar','sfhiv_add_report_navigation',22);
function sfhiv_add_report_navigation(){
	if(is_singular('sfhiv_report')){
		sfhiv_draw_page_navigation(get_the_ID());
	}
}
?>