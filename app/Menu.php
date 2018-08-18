<?php

namespace App;
use DB,Session;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  static  public function saveNew($request){
    $menu = new self();
    $menu ->link = $request['link'];
    $menu ->url = $request['url'];
    $menu ->mtitle = $request['mtitle'];
    $menu -> save();
    Session::flash('sm','Menu saved');
  }
  
  static public function updateItem($request,$id){
    $menu = self::find($id);
    $menu ->link = $request['link'];
    $menu ->url = $request['url'];
    $menu ->mtitle = $request['mtitle'];
    $menu -> save();
    Session::flash('sm','Menu updated');
  }
}
