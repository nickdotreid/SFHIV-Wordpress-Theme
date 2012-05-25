<?
add_action('get_sidebar','sfhiv_add_page_navigation',20);
function sfhiv_add_page_navigation(){
	if(is_page()){
		sfhiv_draw_page_navigation(get_the_ID());
	}
}
?>