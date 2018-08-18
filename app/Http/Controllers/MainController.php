<?php

namespace App\Http\Controllers;
use App\{Categorie,Product,User,Menu,User_rule};
use Illuminate\Http\Request;
use Cart;
use App\News;
class MainController extends Controller
{
  public static $data = ['title'=>'IcomCars | '];
    function __construct() {
      self::$data['menus'] = Menu::all()->toArray();
       self::$data['categories']= Categorie::all()->toArray();
         self::$data['rules'] =  User_rule::all()->toArray();
    }
}
