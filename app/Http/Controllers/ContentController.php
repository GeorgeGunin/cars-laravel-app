<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContentRequest;

use App\Content;
use Session;

class ContentController extends MainController
{
   
    public function index()
    {
       self::$data['contents'] = Content::all()->toArray();
       return view('cms.contents', self::$data);
    }

    public function create()
    {
      return view('cms.add_content',self::$data);
    }

    
    public function store(ContentRequest $request)
    {
        Content::saveNew($request);
        return redirect('cms/content');
    }

   
    public function show($id)
    {
       self::$data['item_id']=$id;
       return view('cms.delete_content',self::$data);
    }

   
    public function edit($id)
    {
      self::$data['item'] = Content::find($id)->toArray(); 
      return view('cms/edit_content', self::$data);
    }

    
    public function update(ContentRequest $request, $id)
    {
      Content::updateItem($request,$id);
      return redirect('cms/content');
    }

    
    public function destroy($id)
    {
       Content::destroy($id);
       Session::flash('sm','Content deleted');
       return redirect('cms/content');
    }
}
