<?php

class Image{
  private $src;
  private $id;
  private $parent;
  private $caption;

  function __construct($id, $src, $parent, $caption){
    $this->id      = $id;
    $this->src     = $src;
    $this->parent  = $parent;
    $this->caption = $caption;
  }

  function __get($val){
    return $this->$val;
  }

  // function that calculates the next 
  // unoccupied id in a given projects image array
  public static function nextId($projId){
    $xmlDb = XmlDb::getInstance(); 
    $images = $xmlDb->xpath('/projects/project[@id="'.$projId.'"]/images/image');

    if (!empty($images)){
      $lastId = (int)$images[count($images) - 1]['id'];
      $nextId = $lastId + 1 ;
    } else {
      $nextId = 0;
    }

    return $nextId;
  }

  public static function handleFileUpload(){
    if ( !isset($_SESSION['currentUser']) ){
      throw new RuntimeException('Not Logged In');
    }
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
      !isset($_FILES['Image']['error']) ||
      is_array($_FILES['Image']['error'])
    ) {
      throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['Image']['error'] value.
    switch ($_FILES['Image']['error']) {
    case UPLOAD_ERR_OK:
      break;
    case UPLOAD_ERR_NO_FILE:
      throw new RuntimeException('No file sent.');
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      throw new RuntimeException('Exceeded filesize limit.');
    default:
      throw new RuntimeException('Unknown errors.');
    }

    // doublecheck filesize here.
    if ($_FILES['Image']['size'] > 3000000) {
      throw new RuntimeException('Exceeded filesize limit.');
    }

    // Check MIME Type 
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
      $finfo->file($_FILES['Image']['tmp_name']),
      array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
      ),
      true
    )) {
      throw new RuntimeException('Invalid file format.');
    }

    // name it uniquely.
    $newFileName = sprintf('sliderImages/%s.%s', uniqid(), $ext);
    if (!move_uploaded_file( $_FILES['Image']['tmp_name'], $newFileName )) {
      throw new RuntimeException('Failed to move uploaded file.');
    }

    return basename($newFileName);
  }

  function writeToProjectsXml(){
    if (!isset($_SESSION['currentUser'])){
      return false;
    }

    // load and instantize the xml file
    $xmlDb = XmlDb::getInstance();

    // find the parent
    $results = $xmlDb->xpath('/projects/project[@id="'.$this->parent.'"]');
    if (!empty($results)) {
      $sxeProject = $results[0]; 
    } else {
      return false;
    }

    $sxeImage = $sxeProject->images->addChild("image");

    // edit/add child nodes
    $sxeImage->caption = $this->caption;
    $sxeImage->src = $this->src;

    // edit/add attributes
    $sxeImage['id'] = $this->id;

    // finaly write it to file
    $xmlDb->asXML(XmlDb::getFile());

    return true;
  }
  
  function RemoveFromProjectsXml(){
    if (!isset($_SESSION['currentUser'])){
      return false;
    }

    // load and instantize the xml file
    $xmlDb = XmlDb::getInstance();

    // find the Image, And NUKE it!
    $results = $xmlDb->xpath('/projects/project[@id="'.$this->parent.'"]/images/image[@id="'.$this->id.'"]');
    if (!empty($results)) {
      unlink(realpath( ".".(string)$results[0]->src )); 
      unset($results[0][0]); // magically removes the image tag
    } else {
      throw new RuntimeException("Can not find image to remove"); 
    }

    // write the changes to file
    $xmlDb->asXML(XmlDb::getFile());

    return true;
  }

}
