<?php
require_once "classes/Image.class.php";

class Project {
  private $id;
  private $title;
  private $description;
  private $type;
  private $images = array();

  function __construct($id, $title, $description = "", $type = ""){
    $this->id          = $id;
    $this->title       = $title;
    $this->description = $description;
    $this->type        = $type;
  }

  // Alternative constructor
  public static function newFromId($id, $projectsXmlFile = 'xml/Projects.xml'){
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    // get the first (and only) project with this id
    $results = $xmlDb->xpath('/projects/project[@id="'.$id.'"]');
    if (!empty($results)) {
      $sxeProject = $results[0]; 
    } else {
      return false;
    }

    $ret = new Project(
      (int)$sxeProject['id'], (string)$sxeProject['title'],
      (string)$sxeProject->description, (string)$sxeProject['type'] );

    // attach images
    foreach($sxeProject->images->image as $image){
      $ret->images[] = new Image(
        (string)$image['id'], (string)$image->src, (int)$sxeProject['id'], (string)$image->caption
      );
    }

    return $ret;
  }

  function __get($val){
    return $this->$val;
  }

  function __set($prop, $val){
    if ($prop == "images") {
      $this->$prop = $val;
    }
  }

  function writeToProjectsXml($projectsXmlFile = 'xml/Projects.xml'){
    // load and instantize the xml file
    $sxeFile = simplexml_load_file($projectsXmlFile);
    $xmlDb = new SimpleXMLElement($sxeFile->asXML());

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

    // edit/add attributes
    $sxeProject['title'] = $this->title;
    $sxeProject['type']  = $this->type;

    // finaly write it to file
    $xmlDb->asXML($projectsXmlFile);
  }
}
