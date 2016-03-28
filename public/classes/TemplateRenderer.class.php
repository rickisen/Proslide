<?php

class TemplateRenderer{
  private function __construct(){}
  private function __clone(){}

  public static function render($data){
    include 'templates/header.php';

/*     if (!isset($data['loadview'])) { */
/*       $data['loadview'] = 'projects'; */ 
/*     } */

    include 'templates/'.$data['loadview'].'.php';

    include 'templates/footer.php';
  }
}
