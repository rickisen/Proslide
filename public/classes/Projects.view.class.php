<?php
require_once 'classes/Project.class.php';

class Projects {
  private function __construct(){}
  private function __clone(){}

  public static function all(){
    // array we will populate with data and return
    $data = array( 'loadview' => 'projects' );

    // load and instantize the xml file
    $projectsXmlFile = "xml/Projects.xml";
    $sxeFile = simplexml_load_file($projectsXmlFile);
    $sxeRoot = new SimpleXMLElement($sxeFile->asXML());

    // construct all projects found in the xml
    $projects = array();
    foreach ($sxeRoot->xpath("//project") as $project) {
      $projects[] = new Project(
        (int)$project['id'], (string)$project['title'],
        (string)$project->description, (string)$project['type'] 
      );
    }

    $data['projects'] = $projects ;

    return $data;
  }
}


