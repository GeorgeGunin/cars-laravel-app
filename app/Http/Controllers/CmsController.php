<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
  Order,
  Product
};
use DB;

class CmsController extends MainController {

  public function dashboard() {

    return view('cms.dashboard', self::$data);
  }

  public function orders() {
    Order::getOrders(self::$data);
    return view('cms.orders', self::$data);
  }

  public function stockUpdate(Request $request) {

    if ($request['op'] == 'plus') {
      DB::table('products')
              ->where('id','=',$request['pid'])
              ->increment('quantity',1);
    }
    elseif($request['op'] == 'minus'){
      {
        DB::table('products')
              ->where('id','=',$request['pid'])
              ->update(['quantity' => DB::raw('GREATEST(quantity - 1,0)')]);
      }
    }
  }

}
