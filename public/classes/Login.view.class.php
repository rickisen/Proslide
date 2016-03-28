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
      require_once "Admin.view.class.php"; 
      return Admin::edit();
    } else {
      require_once "Projects.view.class.php"; 
      unset($_SESSION['currentUser']);
      return Projects::all();
    }
  }
  
  public static function logout(){
      unset($_SESSION['currentUser']);
      require_once "Projects.view.class.php"; 
      return Projects::all();
  }
}
