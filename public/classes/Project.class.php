<?php

class Project {
  private $id;
  private $title;
  private $description;
  private $type;

  function __construct($id, $title, $description = "", $type = ""){
    $this->id          = $id;
    $this->title       = $title;
    $this->description = $description;
    $this->type        = $type;
  }

  function __get($val){
    return $this->$val;
  }

  function writeToProjectsXml($projectsXmlFile = '/xml/Projects.xml'){
    // load and instantize the xml file
    $sxeFile = simplexml_load_file($projectsXmlFile);
    $sxeRoot = new SimpleXMLElement($sxeFile->asXML());

    // if there already is a project with this id, we edit it 
    // instead of creating a new one
    $results = $sxeRoot->xpath('/projects/project[@id="'.$this->id.'"]');
    if (!empty($results)) {
      $sxeProject = $results[0]; 
    } else {
      // add the project, it's basic attributes and children
      $sxeProject = $sxeRoot->addChild("project"); 
      $sxeProject->addAttribute("id", $this->id);
      $sxeImages = $sxeProject->addChild("images"); 
    }

    // edit/add child nodes
    $sxeProject->description = $this->description;

    // edit/add attributes
    $sxeProject['title'] = $this->title;
    $sxeProject['type']  = $this->type;

    // finaly write it to file
    $sxeRoot->asXML($projectsXmlFile);
  }
}
