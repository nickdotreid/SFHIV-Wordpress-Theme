<?php

add_shortcode('document','sfhiv_document_shortcode');
function sfhiv_document_shortcode($atts, $content = null){
	global $post;
	
	extract( shortcode_atts( array(
		'link' => false,
		'title' => false,
		'replace_content' => false,
	), $atts ) );
	
	if($replace_content){
		$content = $replace_content;
	}
	return sfhiv_format_document($link,$title,$content);
}

function sfhiv_format_document($link=false,$title=false,$description=false){
	$mime_type = sfhiv_get_mime_type($link);
	
	ob_start();
	?>
	<div class="attachment <?= $mime_type; ?>">
		<?	if($link):	?><a href="<?=$link;?>"><? endif; ?>
			<i class="attachment"></i>
			<?=apply_filters('the_title',$title,false);?>
		<?	if($link):	?></a><? endif; ?>
		<span class="document-type type" ><?=$mime_type;?></span>
		<span class="document-description description">
			<? if($description) echo apply_filters('the_content',$description);	?>
		</span>
	</div>
	<?
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}


function sfhiv_get_mime_type($file){
	#from http://www.darian-brown.com/php-function-to-get-file-mime-type/
	// our list of mime types
	$mime_types = array(
		"pdf"=>"application/pdf"
		,"exe"=>"application/octet-stream"
		,"zip"=>"application/zip"
		,"docx"=>"application/msword"
		,"doc"=>"application/msword"
		,"xls"=>"application/vnd.ms-excel"
		,"ppt"=>"application/vnd.ms-powerpoint"
		,"gif"=>"image/gif"
		,"png"=>"image/png"
		,"jpeg"=>"image/jpg"
		,"jpg"=>"image/jpg"
		,"mp3"=>"audio/mpeg"
		,"wav"=>"audio/x-wav"
		,"mpeg"=>"video/mpeg"
		,"mpg"=>"video/mpeg"
		,"mpe"=>"video/mpeg"
		,"mov"=>"video/quicktime"
		,"avi"=>"video/x-msvideo"
		,"3gp"=>"video/3gpp"
		,"css"=>"text/css"
		,"jsc"=>"application/javascript"
		,"js"=>"application/javascript"
		,"php"=>"text/html"
		,"htm"=>"text/html"
		,"html"=>"text/html"
	);
	$extension = strtolower(end(explode('.',$file)));
	return $mime_types[$extension];
}


?>