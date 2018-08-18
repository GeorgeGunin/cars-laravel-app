<?php

namespace App;

use DB,
    Image;
use Session;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

  public static function saveNew($request) {
    $image_name = 'No_image_available.svg.png';
    $category = new self();
    $category->ctitle = $request['ctitle'];
    $category->curl = $request['curl'];
    if ($request->hasFile('img') && $request->file('img')->isValid()) {
      $file = $request->file('img');
      $image_name = date('d.m.Y.H.i.s').'-'.$file->getClientOriginalName();
      $request->file('img')->move(public_path() . '/images', $image_name);
      $img = Image::make(public_path() . '/images/' . $image_name);
      $img->resize(300, 200);
      $img->save();
    }
    $category->cimage = $image_name;
    $category->save();
    Session::flash('sm','Category saved');
  }
  
  public static function updateItem($request,$id){
    
    if($request->has('FrDb')){
      Categorie::removeFromDerictory($id);
      $image_name = 'No_image_available.svg.png';
    }
    else{
      $image_name = $request['current_img'];
    }
      
    
    $category = self::find($id);
    $category->ctitle = $request['ctitle'];
    $category->curl = $request['curl'];
    if ($request->hasFile('img') && $request->file('img')->isValid()) {
      $file = $request->file('img');
      $image_name = date('d.m.Y.H.i.s').'-'.$file->getClientOriginalName();
      $request->file('img')->move(public_path() . '/images', $image_name);
      $img = Image::make(public_path() . '/images/' . $image_name);
      $img->resize(300, 200);
      $img->save();
      
    }
    $category->cimage = $image_name;
    
    $category->save();
    Session::flash('sm','Category updated');
  }
  
   public static function removeFromDerictory($id){
    $category = self::find($id);
    if($category){
       if(file_exists(public_path().'/images/'.$category->cimage)){
         unlink(public_path().'/images/'.$category->cimage);
       }
       else
         Session::flash('sm','file does not exist');
    }
  }

}
