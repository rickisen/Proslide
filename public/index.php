<?php
session_start();

// ROUTING ==================================================
//
// Determin which view-class, and method to load
// based on what getrequests we get, 
// or just load the default view-class
if( ! empty($_GET)  ) {
  $url_parts = getUrlParts($_GET) ;
  $class     = array_shift($url_parts);
  $method    = array_shift($url_parts);

  require_once("classes/".$class.".view.class.php"); 
  $data = $class::$method($url_parts); 
} else { // default view
  require_once("classes/Projects.view.class.php"); 
  $data = Projects::all();
}

// Render a page from php templates
require_once("classes/TemplateRenderer.class.php"); 
TemplateRenderer::render($data);

// FUNCTIONS ==================================================
//
// simple function that explodes a 
// string with the '/' character 
// as a delimiter and returns that array
function getUrlParts($get){
  $database   = DB::getInstance();
	$get_params = array_keys($get);
	$url        = $get_params[0];

	$url_parts = explode("/",$url);
	foreach($url_parts as $k => $v){
    $v = stripslashes($v);
		if($v) $array[] = $v;
	}

	$url_parts = $array;
	return $url_parts;
}

