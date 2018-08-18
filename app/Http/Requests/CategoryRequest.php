<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules(Request $request)
    {
      $oldurl = !empty($request['item_id'])? ','.$request['item_id']:'';
        return [
           'ctitle'=>'required',
            'curl'=>'required | unique:categories,curl'.$oldurl,
            'img'=>'image',
        ];
    }
}
