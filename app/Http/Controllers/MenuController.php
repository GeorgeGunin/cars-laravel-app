<?php

namespace App\Http\Controllers;
use App\Http\Requests\ MenuRequest;
use App\Menu;
use Session;
use Illuminate\Http\Request;

class MenuController extends MainController
{
    
    public function index()
    {
        return view('cms.menus', self::$data);
    }

    public function create()
    {
      return view('cms.add_menu',self::$data);
    }

   
    public function store(MenuRequest $request)
    {
      self::$data['menus'] = Menu::saveNew($request);
      return redirect('cms/menu');
    }

   
    public function show($id)
    {
      self::$data['item_id'] = $id;
      return view('cms.delete_menu', self::$data);
    }

    
    public function edit($id)
    {
     if(self::$data['item'] = Menu::find($id))self::$data['item']->toArray();
     return view('cms.edit_menu', self::$data);
    }

   
    public function update(MenuRequest $request, $id)
    {
       Menu::updateItem($request,$id);
        return redirect('cms/menu');
    }

  
    public function destroy($id)
    {
      Menu::destroy($id);
      Session::flash('sm','menu deleted');
      return redirect('cms/menu');
    }
}
