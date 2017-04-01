<?php

defined('BASEPATH') OR exit('No direct script access allowed');


function convertTextToUrl($text){
	//generates the url in the format: base_url/title/id

	    //Lower case everything
	    $text = strtolower($text);
	    //Make alphanumeric (removes all other characters)
	    $text = preg_replace("/[^a-z0-9_\s-]/", "", $text);
	    //Clean up multiple dashes or whitespaces
	    $text = preg_replace("/[\s-]+/", " ", $text);
	    //Convert whitespaces and underscore to dash
	    $text = preg_replace("/[\s_]/", "-", $text);
	    return "$text";
}

function getRelativeUrl(){
	return uri_string();
}

function getYoutubeVideoId($sourceUrl){
	parse_str( parse_url( $sourceUrl, PHP_URL_QUERY ), $my_array_of_vars );
	return $my_array_of_vars['v'];
}

function getYoutubeVideoThumbnailUrl($sourceUrl, $size = "small"){
	$videoId = getYoutubeVideoId($sourceUrl);
	if($size == "small"){
		return "https://i.ytimg.com/vi/".$videoId."/mqdefault.jpg";
	}
	if($size == "medium"){
		return "https://i.ytimg.com/vi/".$videoId."/sddefault.jpg";
	}
	if($size == "large"){
		return "https://i.ytimg.com/vi/".$videoId."/maxresdefault.jpg";
	}
}

function show_error_page(){
	redirect(MBUDDY_HOME.'common/error_page/error');
}