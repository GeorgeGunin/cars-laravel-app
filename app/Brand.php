<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image,Session;
class Brand extends Model
{
  public static function saveNew($request){
    
    $image_name = 'No_image_available.svg.png';
    if($request->hasFile('img') && $request->file('img')->isValid()){
      
      $file = $request->file('img');  
      $image_name = date('d.m.Y.H.i.s').'-'.$file->getClientOriginalName();
      $request->file('img')->move(public_path().'/images',$image_name);
      
      $img = Image::make(public_path().'/images/'.$image_name);
      $img->resize(164,120);
      $img->save();
    }
    
    $brand = new self();
    $brand->name = $request['name'];
    $brand->bimage = $image_name;
    $brand->save();
  }
  public static function removeFromDerictory($id){
    $brand = self::find($id);
    if($brand){
       if(file_exists(public_path().'/images/'.$brand->bimage)){
         unlink(public_path().'/images/'.$brand->bimage);
       }
       else
         Session::flash('sm','file does not exist');
    }
  }
  
  public static function updateItem($request,$id){
    if($request->has('FrDb')){
      Brand::removeFromDerictory($id);
      $image_name = 'No_image_available.svg.png';
    }
    else{
      $image_name = $request['current_img'];
    }
    if($request->hasFile('img') && $request->file('img')->isValid()){
      
      $file = $request->file('img');  
      $image_name = date('d.m.Y.H.i.s').'-'.$file->getClientOriginalName();
      $request->file('img')->move(public_path().'/images',$image_name);
      
      $img = Image::make(public_path().'/images/'.$image_name);
      $img->resize(164,120);
      $img->save();
    }
    
    $brand = self::find($id);
    $brand->name = $request['name'];
    $brand->bimage = $image_name;
    $brand->save();
  }
}
