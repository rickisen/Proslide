<?php

class Image{
  private $src ;
  private $id ;
  private $parent ;
  private $caption ;

  function __construct($id, $src, $parent, $caption){
    $this->id      = $id;
    $this->src     = $src;
    $this->parent  = $parent;
    $this->caption = $caption;
  }

  function __get($val){
    return $this->$val;
  }
}
