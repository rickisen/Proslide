<?php
require_once "classes/Image.class.php";

class Project {
  private $id;
  private $title;
  private $description;
  private $github;
  private $link;
  private $date;
  private $type;
  private $images = array();

  function __construct($id, $title, $description = "", $github = "", $link = "", $date = "", $type = ""){
    $this->id          = $id;
    $this->title       = $title;
    $this->description = $description;
    $this->github      = $github;
    $this->link        = $link;
    $this->type        = $type;

    if (is_int($date)) {
      $this->date = $date; 
    }else{
      $this->date = strtotime($date);
    }
  }

  // Alternative constructor
  public static function newFromId($id){
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    // get the first (and only) project with this id
    $results = $xmlDb->xpath('/projects/project[@id="'.$id.'"]');
    if (!empty($results)) {
      $sxeProject = $results[0]; 
    } else {
      return false;
    }

    $ret = new Project(
      (int)$sxeProject['id'], 
      (string)$sxeProject['title'],
      (string)$sxeProject->description, 
      (string)$sxeProject->github, 
      (string)$sxeProject->link, 
      (int)$sxeProject->date, 
      (string)$sxeProject['type'] 
    );

    // attach images
    foreach($sxeProject->images->image as $image){
      $ret->images[] = new Image(
        (string)$image['id'], 
        (string)$image->src,
        (int)$sxeProject['id'],
        (string)$image->caption,
        (string)$image->title 
      );
    }

    return $ret;
  }

  public static function nextId(){
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    $projects = $xmlDb->xpath("//project"); 
    $lastId = (int)$projects[count($projects) - 1]['id'];
    $nextId = $lastId + 1 ;

    return $nextId;
  }

  function __get($val){
    return $this->$val;
  }

  function __set($prop, $val){
    if ($prop == "images") {
      $this->$prop = $val;
    }
  }

  function writeToProjectsXml(){
    if (!isset($_SESSION['currentUser'])){
      return false;
    }

    // load and instantize the xml file
    $xmlDb = XmlDb::getInstance();

    // if there already is a project with this id, we edit it 
    // instead of creating a new one
    $results = $xmlDb->xpath('/projects/project[@id="'.$this->id.'"]');
    if (!empty($results)) {
      $sxeProject = $results[0]; 
    } else {
      // add the project, it's basic attributes and children
      $sxeProject = $xmlDb->addChild("project"); 
      $sxeProject->addAttribute("id", $this->id);
      $sxeImages = $sxeProject->addChild("images"); 
    }

    // edit/add child nodes
    $sxeProject->description = $this->description;
    $sxeProject->github      = $this->github;
    $sxeProject->link        = $this->link;
    $sxeProject->date        = $this->date;

    // edit/add attributes
    $sxeProject['title'] = $this->title;
    $sxeProject['type']  = $this->type;

    // finaly write it to file
    $xmlDb->asXML(XmlDb::getFile());

    return true;
  }
}
