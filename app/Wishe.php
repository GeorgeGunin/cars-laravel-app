<?php

namespace App;

use App\Product,
    DB;
use Illuminate\Database\Eloquent\Model;

class Wishe extends Model {

  public static function addWish($id, $pid) {
    if (self::where('uid',$id)->where('pid',$pid)->get()->isEmpty()) {
      $product = DB::table('products AS p')
              ->join('categories AS c', 'c.id', '=', 'p.categorie_id')
              ->where('p.id', '=', $pid)
              ->select('c.curl', 'p.*')
              ->first();

      if ($product) {
        $wish = new self();
        $wish->uid = $id;
        $wish->curl = $product->curl;
        $wish->pid = $product->id;
        $wish->purl = $product->purl;
        $wish->ptitle = $product->ptitle;
        $wish->price = $product->price;
        $wish->pimage = $product->pimage;
        $wish->save();
      }
    }
  }

  public static function getWish(&$data, $id) {
    $whish = self::where('uid', $id)
            ->get();
    if ($whish)
      $data['whishlist'] = $whish->toArray();
  }

  public static function deleteItem($id, $uid) {
     self :: where('uid', $uid)->where('pid', $id)->delete();
  }
 
}
