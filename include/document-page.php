<?php

add_action('get_sidebar','sfhiv_add_document_navigation',22);
function sfhiv_add_document_navigation(){
	if(is_singular('sfhiv_document')){
		sfhiv_draw_page_navigation(array(get_the_ID()));
	}
}

?>