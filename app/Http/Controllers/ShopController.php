<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{
  Product,
  Order,
  Wishe,
  Post
};
use Cart,
    Session,
    DB;

class ShopController extends MainController {

  public function categories() {
    self::$data['title'] .= 'Categories';
    return view('content.categories', self::$data);
  }

  public function category($url) {
    Product::getProducts($url, self::$data);
    if (self::$data['products'])
      self::$data['title'] .= self::$data['products'][0]->ctitle;
    else
      self::$data['title'] .= $url;
    return view('content.products', self::$data);
  }

  public function select($curl, $orderBy, $select) {
    Product::getProducts($curl, self::$data, $select);
    if (self::$data['products'])
      self::$data['title'] .= self::$data['products'][0]->ctitle;
    return view('content.products', self::$data);
  }

  public function product(Request $request, $curl, $purl) {
    
    Product::getItemModel($purl, self::$data);
    return view('content.product', self::$data);
  }

  public function addToCart(Request $request) {

    $curl = filter_var($request['curl'], FILTER_SANITIZE_STRING);
    $curl = trim($curl);
    if ($curl) {
      Product::addToCart($request['pid'], $curl);
    }
  }

  public function updateCart(Request $request) {
    Product::updateCart($request['pid'], $request['op']);
  }

  public function checkout() {
    Session::put('visited', true);
    $incart = Cart::getContent()->toArray();
    sort($incart);
    self::$data['incart'] = $incart;
    self::$data['title'] .= 'Shopping cart';
    return view('content.checkout', self::$data);
  }

  public function deleteItem(Request $request) {
    Cart::remove($request['id']);
    return redirect('shop/shopping-cart');
  }

  public function getWish() {
    if (Session::has('user_id')) {
      $id = Session::get('user_id');
      self::$data['title'] .= ' Wish list';
      Wishe::getWish(self::$data, $id);
      return view('content.wishlist', self::$data);
    }
    Session::flash('sm', 'Please sign in');
    return redirect('user/signin');
  }

  public function addWish(Request $request) {
    if (Session::has('user_id') && $request['pid'] && is_numeric($request['pid'])) {
      $id = Session::get('user_id');
      $pid = $request['pid'];
      Wishe::addWish($id, $pid);
    }
    $caturl = trim($request['curl']);
    $prdurl = trim($request['purl']);
    if (!$prdurl)
      return redirect('shop' . '/' . $caturl);
    elseif ($prdurl)
      return redirect('shop' . '/' . $caturl . '/' . $prdurl);
  }

  public function deleteFromWish(Request $request) {

    if (Session::has('user_id') && $request['pid'] && $request['uid'] && is_numeric($request['pid']) && is_numeric($request['uid'])) {
      if ($request['uid'] == Session::get('user_id')) {
        Wishe::deleteItem($request['pid'], $request['uid']);
      }
    }
    return redirect('shop/wish-list');
  }

  public function clearWish(Request $request) {
    if ($request['uid'] && is_numeric($request['uid']) && $request['uid'] == Session::get('user_id'))
      Wishe::where('uid', $request['uid'])->delete();
    return redirect('shop/wish-list');
  }

  public function clearCart() {
    Cart::clear();
    return redirect('shop/shopping-cart');
  }

  public function order() {
    if (Cart::isEmpty())
      return redirect('shop');
    else if (!Session::has('user_id')) {
      return redirect('user/signin');
    } else {
      Order::saveNew();
    }
    return redirect('shop');
  }


}
