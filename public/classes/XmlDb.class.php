<?php

class XmlDb{
  private static $instance;
  private static $users;
  private function __construct(){}
  private function __clone(){}

  public static function getInstance(){
    if(!self::$instance){
      $config = parse_ini_file('/config.ini');

      // load and instantize the xml file
      $sxeFile = simplexml_load_file($config['dbPath']);
      self::$instance = new SimpleXMLElement($sxeFile->asXML());

      return self::$instance;
    }else{
      return self::$instance;
    }
  }

  public static function getUsers(){
    if(!self::$users){
      $config = parse_ini_file('/config.ini');

      // load and instantize the xml file
      $sxeFile = simplexml_load_file($config['usersPath']);
      self::$users = new SimpleXMLElement($sxeFile->asXML());

      return self::$users;
    }else{
      return self::$users;
    }
  }
}
