<?php

namespace App\Http\Controllers;
use App\User,Session;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UserRequest;

class UsersController extends MainController {
  
  public function __construct() {
    parent::__construct();
  $this->middleware('authguard',['except'=>['logout','getProfile','postProfile']]);
  }

  public function getSignin() {
    self::$data['title'] .= ' Sign in page';
    return view('form.signin', self::$data);
  }

  public function postSignin(SignInRequest $request) {
    self::$data['title'] .= 'Sign in page';
    if(User::verify($request))
    { 
      if(!Session::get('visited')){
        if(Session::has('url'))
          return redirect(Session::get('url'));
        return redirect('');
      }
      else
        return redirect('shop/shopping-cart');
    }
    else {
     return view('form.signin', self::$data)->withErrors('Wrong email and password'); 
    }
    
  }
  
  public function logout(){
    Session::flush();
    return redirect('user/signin');
  }

  public function getSignup(){
   self::$data['title'] .= 'Sign up page';
   return view('form.signup', self::$data);
  }
  
  public function postSignup(SignUpRequest $request){
   if(User::saveNew($request))   
    return redirect('');
   else{
     return redirect(url()->current());
   }
  }
  
  public function getProfile(){
    if(!Session::has('user_id'))
      return redirect('user/signin');
    else{
      self::$data['title'].= Session::get('user_name').' profile';
      User::getUserInfo(self::$data);
      Order::getUserOrder(self::$data);
      return view('form.personal_info', self::$data);
    }
  }
  
  public function postProfile(UserRequest $request){
    User::editProfile($request);
    return redirect('');
  }
}
