<?php
require_once 'classes/Projects.view.class.php';
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

  public static function addImage(){
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    try {
      $imageFileName = Image::handleFileUpload(); 
    }
    catch (RuntimeException $e) {
      /* echo $e->getMessage(); */
      return Projects::all(); 
    }

    if (!empty($imageFileName) && isset($_POST['projId']) && isset($_POST['Caption'])){
      $freshImage = new Image(Image::nextId($_POST['projId']), "/sliderImages/$imageFileName", $_POST['projId'], $_POST['Caption'] ); 
    } else {
      throw new RuntimeException("Failed to recieve image post"); 
    }

    if ($freshImage->writeToProjectsXml()){
      return self::edit();
    } else {
      return Projects::all(); 
    }
  }

  public static function removeImages(){
    if (isset($_POST['removeFromProject']) && 
        isset($_POST['removeImages']) && 
        count($_POST['removeImages']) > 0 ){
      $project = Project::newFromId($_POST['removeFromProject']);

      foreach ($_POST['removeImages'] as $imageId) {
        $project->images[$imageId]->RemoveFromProjectsXml();
      }
    }
  }

  public static function addProject(){
    // get the last projects id, and calculate a new one from that.
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    $newProject = new Project(Project::nextId(), $_POST['Title'], $_POST['Description'], $_POST['type']); 
    if ($newProject->writeToProjectsXml()){
      return self::edit();
    } else {
      return Projects::all(); 
    }
  }

}
