<?php
require_once 'classes/Project.class.php';

class Admin{
  private function __construct(){}
  private function __clone(){}

  public static function edit(){
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    // array we will populate with data and return
    $data = array( 'loadview' => 'edit' );

    // construct all projects found in the xml
    $projects = array();
    foreach ($xmlDb->xpath("//project") as $sxeProject) {
      $projects[] = Project::newFromId((int)$sxeProject['id']);
    }

    $data['projects'] = $projects ;

    return $data;
  }

}
