<?php

class Login{
  private function __construct(){}
  private function __clone(){}

  public static function form(){
    $data = array( 'loadview' => 'login' );
    return $data;
  }

  public static function auth(){
    $_SESSION['currentUser'] = new User($_POST['userName'], $_POST['password']);

    if ($_SESSION['currentUser']->authenticate()){
      header('location:/?/Admin/edit'); 
    } else {
      unset($_SESSION['currentUser']);
      header('location:/?/Login/form'); 
    }
  }
  
  public static function logout(){
      unset($_SESSION['currentUser']);
      header('location:/?/Projects/all'); 
  }
}
