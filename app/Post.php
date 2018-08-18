<?php

namespace App;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  public function user() {

   return $this->belongsTo(User::class); //post belongs to one user
  }
  public function product(){
    return $this->belongsTo(Product::class);//
  }
  public static function saveNew($request) {
    if($request['fpost'] && $request['product_id'] && is_numeric($request['product_id'])){
      $user_post = filter_var($_REQUEST['fpost'],FILTER_SANITIZE_STRING);
      $user_post=trim($user_post);
      $product_id = filter_var($_REQUEST['product_id'],FILTER_SANITIZE_STRING);
      $product_id=trim($product_id);
    $data['product'] = DB::table('products AS p')
            ->join('categories AS c', 'p.categorie_id', '=', 'c.id')
            ->where('p.id', '=', $product_id)
            ->select('p.ptitle', 'p.pimage', 'p.purl', 'c.curl')
            ->first();
    $data['user'] = DB::table('users')->where('id', '=', session('user_id'))->select('uimage')->first();
    $post = new self();
    $post->body = $user_post;
    $post->user_id = session('user_id');
    $post->product_id = $product_id;
    $post->user_name = session('user_name');
    $post->product_name = $data['product']->ptitle;
    $post->pimage = ($data['product']->pimage);
    $post->u_image = ($data['user']->uimage);
    $post->curl = ($data['product']->curl);
    $post->purl = ($data['product']->purl);
    $post->save();
    Session::flash('sm', 'post succesfully created!');
  }
  }
  public static function getPosts($id) {
    $post = [];
    $post = self::where('product_id', '=', $id)->paginate(5);
    return $post;
  }

  public static function getLastPosts() {
        
  return self::with('product','user')->orderBy('created_at', '=', 'desc')->limit(2)->get();
  }

  public static function getAll($request) {
    if ($request['user_name'] && $request['title'] || $request['user_name'] || $request['title']) {
      return  self::where('user_name', 'like', '%' . $request['user_name'] . '%')
                      ->where('product_name', 'like', '%' . $request['title'] . '%')
                      ->get();
    }
    else {
      return self::all();
    }
  }

}
