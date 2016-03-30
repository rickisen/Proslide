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
    } catch (RuntimeException $e) {
      /* echo $e->getMessage(); */
      header("location:/?/Admin/edit"); 
    }

    if (!empty($imageFileName) && isset($_POST['Title']) && isset($_POST['projId']) && isset($_POST['Caption'])){
      $freshImage = new Image(Image::nextId($_POST['projId']), "/sliderImages/$imageFileName", $_POST['projId'], $_POST['Caption'], $_POST['Title'] ); 
    } else {
      throw new RuntimeException("Failed to recieve image post"); 
    }

    $freshImage->writeToProjectsXml(); 
    header("location:/?/Admin/edit"); 
  }

  public static function removeImages(){
    if (isset($_POST['removeFromProject']) && 
        isset($_POST['removeImages']) && 
        count($_POST['removeImages']) > 0 ){
      $project = Project::newFromId($_POST['removeFromProject']);

      // Go through each image in the project and 
      // if its id matches one requested for removal, nuke it.
      foreach ($project->images as $image) {
        if (in_array($image->id, $_POST['removeImages'])) {
          $image->RemoveFromProjectsXml();
        }
      }
    }
    header("location:/?/Admin/edit"); 
  }

  public static function addProject(){
    // get the last projects id, and calculate a new one from that.
    $xmlDb = XmlDb::getInstance(); // load and the xml file

    $newProject = new Project(Project::nextId(), $_POST['Title'], $_POST['Description'], $_POST['type']); 
    $newProject->writeToProjectsXml(); 

    header("location:/?/Admin/edit"); 
  }

}
