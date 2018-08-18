<?php

namespace App\Service;
use App\Brand;
use App\User;

class Data{

  public $brand;
 
  public function __construct() {
    $this->brand = Brand::all()->toArray() ;
  }
  
}



