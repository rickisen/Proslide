<?php
require_once "classes/User.class.php";
require_once "classes/XmlDb.class.php";

session_start();

// ROUTING ==================================================
//
// Determin which view-class, and method to load
// based on what getrequests we get, 
// or just load the default view-class
if( ! empty($_GET)  ) {
  $allowedViews = ["Project", "Login"]; 

  $url_parts = getUrlParts($_GET) ;
  $class     = array_shift($url_parts);
  $method    = array_shift($url_parts);

  if (in_array($class, $allowedViews) || isset($_SESSION['currentUser'])){
    require_once("classes/".$class.".view.class.php"); 
    $data = $class::$method($url_parts); 
  } else {
    require_once("classes/Login.view.class.php"); 
    $data = Login::form();
  }
} else { // default view
  require_once("classes/Projects.view.class.php"); 
  $data = Projects::all();
}

// in case a function did not give the loadview setting
if (!isset($data['loadview'])){
  $data['loadview'] = "projects"; 
}

// Render the page from php templates
require_once("classes/TemplateRenderer.class.php"); 
TemplateRenderer::render($data);

// FUNCTIONS ==================================================
//
// simple function that explodes a 
// string with the '/' character 
// as a delimiter and returns that array
function getUrlParts($get){
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

