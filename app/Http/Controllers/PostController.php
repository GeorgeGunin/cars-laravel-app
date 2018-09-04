<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Session;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PostController extends MainController {

  public function postCreatePost(PostRequest $request) {

    if (!empty($request['product_id']) && is_numeric($request['product_id'])) 
      Post::saveNew($request);
      return redirect(Session::get('url'));
    
  }

  public function postDeletePost($curl, $purl, $id) {
    if (!empty($id) && is_numeric($id)) {
      $post = Post::where('id', '=', $id)->where('user_id', '=', session::get('user_id'))->delete();
      return back();
    }
  }

  public function getAllPosts(Request $request) {

    $posts = Post::with('user:id,name,uimage', 'product:id,ptitle')->whereHas('user',function($query) use ($request) {
      $query->where('name', 'like', '%' . $request['user_name'] . '%');     
    })
    ->whereHas('product',function($query) use ($request){
      $query->where('ptitle', 'like', '%' . $request['title'] . '%');   
    });
    

    return View::make('cms.posts', self::$data)->with('posts', $posts->get());
  }

  public function getDeleteFormPost($id) {
    self::$data['post_id'] = $id;
    return view('cms.delete_post', self::$data);
  }

  public function deletePost(Request $request) {
    if (!empty($request['post_id']) && is_numeric($request['post_id']) && session::get('is_admin', true)) {
      $post = Post::where('id', '=', $request['post_id'])->delete();
      return redirect('cms/posts');
    }
  }

}
