<?php

class User{
  private $name;
  private $password;

  function __construct($name, $password){
    $this->name = $name;
    $this->password = $password; 
  }

  function __get($prop){
    if ($prop == "password"){
      return false;
    } else {
      return $this->$prop;
    }
  }

  function authenticate(){
    $xml = XmlDb::getUsers();
    $results = $xml->xpath('/users/user[@name="'.$this->name.'"]'); 
    if ($results){
      $storedUser = $results[0]; 
    } else {
      return false;
    }

    if (!empty($storedUser) && password_verify($this->password, (string)$storedUser->password)){
      unset($this->password); // dont want to store in cleartext after this
      return true;
    }

    return false;
  }


}
