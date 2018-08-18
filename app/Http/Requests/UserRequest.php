<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest {

  public function authorize() {
    return true;
  }

  public function rules(Request $request) {
    $user = !empty($request['user'])? ','.$request['user']:'';
    return [
        'name' => 'required|min:2|max:70',
        'email' => 'required|email|unique:users,email' . $user,
        'password' => 'required|min:6|max:10|confirmed',
        'uimage' =>'image',
        'rule' =>'required | numeric',
    ];
  }

}
