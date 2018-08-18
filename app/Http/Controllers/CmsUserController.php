<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Categorie;
use Session;
use App\User;
use App\User_rule;
class CmsUserController extends MainController
{
   
    public function index()
    {
      User::getAllUserProfiles(self::$data);
      return view('cms.users', self::$data);
    }

    public function create()
    {
      return view('cms.add_user',self::$data);
    }

    
    public function store(UserRequest $request)
    {
       User::saveNew($request);
        return redirect('cms/users');
    }

   
    public function show($id)
    {
       self::$data['item_id']=$id;
       return view('cms.delete_user',self::$data);
    }

   
    public function edit($id)
    {
      self::$data['item'] = User::findUser($id); 
      return view('cms/edit_user', self::$data);
    }

    
    public function update(UserRequest $request, $id)
    { 
     User::updateUser($request,$id);
     return redirect('cms/users');
    }

    
    public function destroy(Request $request ,$id)
    {
       if($request->has('FrDb')){
        User::removeFromDerictory($id);
      }
       User::destroy($id);
       User_rule::where('uid',$id)->delete();
       Session::flash('sm','User deleted');
       return redirect('cms/users');
    }
    
    
}
