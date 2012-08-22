<?php

function sfhiv_extract_toc($html_string,$depth=3){
	$pattern = '/<h[2-'.$depth.']*[^>]*>.*?<\/h[2-'.$depth.']>/';
	$whocares = preg_match_all($pattern,$html_string,$winners);
	
	$links = array();
	foreach($winners[0] as $link){
		$_link = array();
		$pieces = explode('name="',$link);
		$pieces = explode('"',$pieces[1]);
		$_link['anchor'] =  $pieces[0];
		$pieces = explode(">",$pieces[count($pieces)-1]);
		$pieces = explode("<",$pieces[1]);
		$_link['title'] =  $pieces[0];
		$links[] = $_link;
	}
	return $links;
}

?>