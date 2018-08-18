<?php

namespace App;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use DB,
    Cart,
    Session,
    Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  public function category(){
    return $this->belongsTo(Categorie::class,'categorie_id');
  }
  public function posts(){
    return $this->hasMany(Post::class);
  }
  
  public static function getAllNew(&$data) {
    $products = [];
    $products = DB::table('products AS p')
            ->join('categories AS c', 'p.categorie_id', '=', 'c.id')
            ->select('p.*', 'c.curl')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    if ($products) {
      $products = $products->toArray();
    }
    $data['new_products'] = $products;
  }

  public static function getProducts($url, &$data, $select = '') {
    $order = 'ASC';
    if ($select && $select == 'high-to-low')
      $order = 'DESC';

    $products = DB::table('categories AS c')
            ->join('products AS p', 'c.id', '=', 'p.categorie_id')
            ->where('c.curl', '=', $url)->select('p.*', 'c.curl', 'c.ctitle')
            ->orderBy('p.price', $order)
            ->get();
    if ($products)
      $data['products'] = $products->toArray();
    $data['all_products'] = Product::all()->toArray();
  }

//  public static function getItem($purl, &$data) {
//
//    $data['item'] = DB::table('products AS p')
//            ->join('categories AS c', 'p.categorie_id', '=', 'c.id')
//            ->where('purl', $purl)
//            ->select('p.*', 'c.curl', 'c.ctitle')
//            ->first();
//    if ($data['item']) {
//      $data['title'] .= $data['item']->ptitle;
//    }
//  }
  
  public static function   getItemModel($purl, &$data){
    
    $data['item'] = self::where('purl',$purl)->with('category:id,curl,ctitle')->first();
    if ($data['item']) {
      $data['title'] .= $data['item']->ptitle;
    }
      $data['item']->posts = $data['item']->posts()->with('user')->paginate(2);
  }


    public static function addToCart($pid,$curl) {

    if (!empty($pid) && is_numeric($pid)) {

      if ($product = Product::find($pid)) {
        $product = $product->toArray();
        if (!Cart::get($pid)) {
          Cart::add($pid, $product['ptitle'], $product['price'], 1, ['pimage' => $product['pimage'], 'purl' => $product['purl'], 'curl' => $curl, 'quantity' => $product['quantity']]);
          Session::flash('sm', $product['ptitle'] . ' is added to cart');
        }
      }
    }
  }

  public static function updateCart($pid, $op) {
    if (!empty($pid) && is_numeric($pid) && !empty($op)) {
      if ($op == 'minus') {
        Cart::update($pid, ['quantity' => -1]);
      }
      if ($op == 'plus') {
        Cart::update($pid, ['quantity' => 1]);
      }
    }
  }

  public static function saveNew($request) {
    $image_name = 'No_image_available.svg.png';
    $big_image = '1024px-No_image_available.svg.png';
    if ($request->hasFile('img') && $request->file('img')->isValid()) {

      $file = $request->file('img');
      $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();

      $request->file('img')->move(public_path() . '/images', $image_name);

      $img_small = Image::make(public_path() . '/images/' . $image_name);
      $img_small->resize(556, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img_big = Image::make(public_path() . '/images/' . $image_name);

      $img_small->save();
      $img_big->save(public_path() . '/images/' . '-big-' . $image_name);
      $big_image = '-big-' . $image_name;
    }

    $product = new self();
    $product->categorie_id = $request['category'];
    $product->ptitle = $request['ptitle'];
    $product->particle = $request['particle'];
    $product->purl = $request['purl'];
    $product->price = $request['price'];
    $product->bigimage = $big_image;
    $product->pimage = $image_name;
    $product->quantity = $request['quantity'];
    $product->save();
    Session::flash('sm', 'Product saved');
  }

  public static function updateItem($request, $id) {

    if ($request->has('FrDb')) {
      Product::removeFromDerictory($id);
      $image_name = 'No_image_available.svg.png';
      $big_image = '1024px-No_image_available.svg.png';
    } else {
      $image_name = $request['current_img'];
      $big_image = $request['currentbig_img'];
    }

    if ($request->hasFile('img') && $request->file('img')->isValid()) {

      $file = $request->file('img');
      $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();

      $request->file('img')->move(public_path() . '/images', $image_name);

      $img_small = Image::make(public_path() . '/images/' . $image_name);
      $img_small->resize(556, 370);
      $img_big = Image::make(public_path() . '/images/' . $image_name);

      $img_small->save();
      $img_big->save(public_path() . '/images/' . '-big-' . $image_name);
      $big_image = '-big-' . $image_name;
    }

    $product = self::find($id);
    $product->categorie_id = $request['category'];
    $product->ptitle = $request['ptitle'];
    $product->particle = $request['particle'];
    $product->purl = $request['purl'];
    $product->price = $request['price'];
    $product->bigimage = $big_image;
    $product->pimage = $image_name;
    $product->quantity = $request['quantity'];
    $product->save();
    Session::flash('sm', 'Product updated');
  }

  public static function removeFromDerictory($id) {
    $product = self::find($id);
    if ($product) {
      if (file_exists(public_path() . '/images/' . $product->pimage) && $product->pimage != "No_image_available.svg.png" && $product->bigimage != "1024px-No_image_available.svg.png") {
        unlink(public_path() . '/images/' . $product->pimage);
        unlink(public_path() . '/images/' . $product->bigimage);
      } else
        Session::flash('sm', 'file does not exist');
    }
  }

  public static function getLastForHomePage(&$data) {
    $data['last_products'] = DB::table('products AS p')
                    ->join('categories AS c', 'c.id', '=', 'p.categorie_id')
                    ->select('p.*', 'c.curl')
                    ->orderBy('p.created_at', 'desc')
                    ->limit(8)
                    ->get()->toArray();
  }

  public static function searchProduct() {
    $res = [];
    $term = filter_var(Input::get('term'),FILTER_SANITIZE_STRING);
    $term = trim($term);
    $term = Str::lower($term);
    $data = DB::table('products')
                    ->distinct()
                    ->select('ptitle')
                    ->where('ptitle', 'LIKE','%'. $term . '%')
                    ->groupBy('ptitle')
                    ->take(10)->get();
    foreach ($data as $v) {
      $res[] = array("value" => $v->ptitle);
    }
    return Response::json($res);
  }

  public static function getSarchedProduct($keyword) {
    $data = DB::table('products AS p')
            ->join('categories AS c', 'c.id', '=', 'p.categorie_id')
            ->where('p.ptitle', '=', $keyword)
            ->select('p.ptitle', 'p.purl', 'c.curl')
            ->first();
    return $data;
  }

}
