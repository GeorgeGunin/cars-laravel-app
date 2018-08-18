<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;


use Session;
use App\Brand;
use App\Service\Data;


class BrandController extends MainController
{
   
    public function index()
    {
      $brands = new Data();
      self::$data['brands']= $brands->brand;
      return view('cms.brands', self::$data);
    }

    public function create()
    {
      
      return view('cms.add_brand',self::$data);
    }

    
    public function store(BrandRequest $request)
    {
      
        Brand::saveNew($request);
        return redirect('cms/brand');
    }

   
    public function show($id)
    {
       self::$data['item_id']=$id;
       return view('cms.delete_brand',self::$data);
    }

   
    public function edit(Request $request, $id)
    {
      self::$data['item'] = Brand::find($id)->toArray(); 
      return view('cms/edit_brand', self::$data);
    }

    
    public function update(BrandRequest $request, $id)
    {
     
     Brand::updateItem($request,$id);
     return redirect('cms/brand');
    }

    
    public function destroy($id,Request $request)
    {  
      if($request->has('FrDb')){
        Brand::removeFromDerictory($id);
      }
       Brand::destroy($id);
       Session::flash('sm','Brand deleted');
       return redirect('cms/brand');
    }
}
