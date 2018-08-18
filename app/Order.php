<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cart,
    Session,
    DB;
use Carbon;

class Order extends Model {

  public static function saveNew() {
    $order = Cart::getContent()->toArray();
    foreach ($order as $item){
      //dd($item);
      $quantity = $item['quantity'];
      DB::table('products')
              ->where('id','=',$item['id'])
              ->update(['quantity' => DB::raw("GREATEST(quantity - $quantity,0)")]);
    }
    $orders = new self();
    $orders->user_id = Session::get('user_id');
    $orders->data = serialize($order);
    $orders->total = Cart::getTotal();
    $orders->save();
    Cart::clear();
    Session::flash('sm', 'Thank you ' . Session::get('user_name') . ' you order saved');
  }

  public static function getUserOrder(&$data) {
    if (Session::has('user_id')) {
      $orders = DB::table('orders')
              ->where('user_id', '=', Session::get('user_id'))
              ->orderBy('created_at', 'DESC')
              ->select('data','created_at')
              ->paginate(7);
      if (!$orders->isEmpty())
        $data['orders'] = $orders;
      else
        $data['orders']=[];

    }
  }
  
  public static function getOrders(&$data){
    $orders =[];
    $orders = DB::table('orders AS o')
            ->join('users AS u','u.id','=','o.user_id')
            ->orderBy('o.created_at','DESC')
            ->select('o.*','u.name','u.email','u.uimage')
            ->paginate(5);
    if(!$orders->isEmpty()){
      $data['orders'] = $orders;  
    }
    else
    $data['orders']= [];
  }

}
