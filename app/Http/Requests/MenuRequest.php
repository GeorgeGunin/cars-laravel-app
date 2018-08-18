<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules(Request $request)
    {
      $item_id = !empty($request['item_id']) ? ','.$request['item_id']: '';
        return [
           'link'=>'required',
            'url'=> 'required |regex:/^[a-z\d]+(-[a-z\d]+)*$/ |unique:menus,url'.$item_id,
            'mtitle'=>'required',
        ];
    }
}
