<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use App\Categorie;
use Session;

class CategoryController extends MainController
{
   
    public function index()
    {
      return view('cms.categories', self::$data);
    }

    public function create()
    {
      return view('cms.add_category',self::$data);
    }

    
    public function store(CategoryRequest $request)
    {
      
        Categorie::saveNew($request);
        return redirect('cms/category');
    }

   
    public function show($id)
    {
       self::$data['item_id']=$id;
       return view('cms.delete_category',self::$data);
    }

   
    public function edit($id)
    {
      self::$data['item'] = Categorie::find($id)->toArray(); 
      return view('cms/edit_category', self::$data);
    }

    
    public function update(CategoryRequest $request, $id)
    {
      Categorie::updateItem($request,$id);
      return redirect('cms/category');
    }

    
    public function destroy(Request $request, $id)
    {
      if($request->has('FrDb')){
        Categorie::removeFromDerictory($id);
      }
       Categorie::destroy($id);
       Session::flash('sm','Category deleted');
       return redirect('cms/category');
    }
}
