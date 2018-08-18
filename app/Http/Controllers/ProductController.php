<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Categorie;
use Session;
use App\Product;

class ProductController extends MainController
{
   
    public function index()
    {
      self::$data['all_products'] = Product::all()->toArray();
      return view('cms.products', self::$data);
    }

    public function create()
    {
      return view('cms.add_product',self::$data);
    }

    
    public function store(ProductRequest $request)
    {
        Product::saveNew($request);
        return redirect('cms/product');
    }

   
    public function show($id)
    {
       self::$data['item_id']=$id;
       return view('cms.delete_product',self::$data);
    }

   
    public function edit($id)
    {
      self::$data['item'] = Product::find($id)->toArray(); 
      return view('cms/edit_product', self::$data);
    }

    
    public function update(ProductRequest $request, $id)
    {
     
     Product::updateItem($request,$id);
     return redirect('cms/product');
    }

    
    public function destroy(Request $request ,$id)
    {
       if($request->has('FrDb')){
        Product::removeFromDerictory($id);
      }
       Product::destroy($id);
       Session::flash('sm','Product deleted');
       return redirect('cms/product');
    }
    
    
}
