<?php

class TemplateRenderer{
  private function __construct(){}
  private function __clone(){}

  public static function render($data){
    include 'templates/header.php';
    
    include 'templates/'.$data['loadview'].'.php';

    /* echo "<pre>"; */
    /* print_r($data); */
    /* echo "</pre>"; */

    include 'templates/footer.php';
  }
}
