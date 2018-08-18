<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Content;
use App\Product;
use App\Post;
use App\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use DB;
class PagesController extends MainController
{
    public function home(){
     self::$data['title'].='Home page'; 
     Product::getAllNew(self::$data);
     Product::getLastForHomePage(self::$data);
     self::$data['posts'] = Post::getLastPosts();
     return view('content.home',self::$data);
    }
    
    public function content($url){
      Content::getContent($url,self::$data);
      return view('content.contents',self::$data);
    }
    
    public function searchProduct(){
      return Product::searchProduct();
     }
     
     public function getProducts(){
       $keyword = Str::lower(Input::get('search'));
       $res = Product::getSarchedProduct($keyword);
       if($res){
         return redirect(url('shop').'/'.$res->curl.'/'.$res->purl);
       }
       else{
         return back();
       }
     }
}
