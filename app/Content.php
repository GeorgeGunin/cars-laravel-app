<?php

namespace App;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
   public static function getContent($url,&$data){
     
    $data['contents'] = DB::table('contents AS c')
             ->join('menus AS m','m.id','=','c.menu_id')
             ->where('m.url','=',$url)
             ->get()->toArray();
     if(!empty($data['contents'][0]->mtitle))
       $data['title'] .=  $data['contents'][0]->mtitle;
   }
   
   public static function saveNew($request){
     $content = new self();
     $content-> menu_id = $request['menu'];
     $content-> title = $request['title'];
     $content-> article = $request['article'];
     $content->save();
     Session::flash('sm','Content saved');
   } 
   
   public static function updateItem($request,$id){
     $content = self::find($id);
     $content-> menu_id = $request['menu'];
     $content-> title = $request['title'];
     $content-> article = $request['article'];
     $content->save();
     Session::flash('sm','Content updated');
     
   }
}
