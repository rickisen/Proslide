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
    foreach ($sxeRoot->xpath("//project") as $sxeProject) {
      $projects[] = Project::newFromId((int)$sxeProject['id']);
    }

    $data['projects'] = $projects ;

    return $data;
  }
}


