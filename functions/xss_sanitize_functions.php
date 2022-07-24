<?php // Sanitize functions
// Make sanitizing easy and you will do it often

// Sanitize for HTML output 
function h($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Sanitize for JavaScript output
function j($string) {
	return json_encode($string);
}

// Sanitize for use in a URL
function u($string) {
	return urlencode($string);
}
function dirty_html($string){
	return strip_tags($string);
}


function filter($string){

	return filter_var($string, FILTER_SANITIZE_STRING);
}


?>
