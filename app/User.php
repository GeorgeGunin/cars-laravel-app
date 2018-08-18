<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Session,
    DB,
    Image;

class User extends Model {
  
  public function posts(){
    return $this->hasMany(Post::class);
  }

  public static function verify($request) {

    $auth = false;
    $valid = DB::table('users AS u')
            ->join('user_rules AS ur', 'ur.uid', '=', 'u.id')
            ->where('u.email', '=', $request['email'])
            ->select('ur.rid', 'u.*')
            ->first();
    if ($valid) {
      if (Hash::check($request['password'], $valid->password)) {
        Session::put('user_id', $valid->id);
        Session::put('user_name', $valid->name);
        if ($valid->rid == 6)
          Session::put('is_admin', true);
        Session::flash('sm', 'Welcome back ' . $valid->name);
        $auth = true;
      }
    }
    return $auth;
  }

  public static function saveNew($request) {
    $image_name = 'defaul-tprofile.png';
    $saved = false;
    $user = new self();
    $user->name = $request['name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->uimage = $image_name;
    $user->save();
    $uid = $user->id;

    if ($uid) {
      if ($request['rule'] && session('is_admin')) {
        $rule = $request['rule'];
//        $user = new User($request);
//        $user->save()
        DB::insert("INSERT INTO user_rules VALUES($uid,$rule)");
        Session::flash('sm', 'User saved');
        $saved = true;
      } else {
        DB::insert("INSERT INTO user_rules VALUES($uid,7)");
        $saved = true;
        Session::put('user_id', $uid);
        Session::put('user_name', $user->name);
        Session::flash('sm', 'Thank you ' . $user->name . ' your account saved successfuly');
      }
    }
    return $saved;
  }

  public static function getUserInfo(&$data) {

    if ($user_info = self::where('id', Session('user_id'))->first()) {
      $data['user_info'] = $user_info->toArray();
    }
  }

  public static function editProfile($request) {

    $image_name = 'defaul-tprofile.png';
    $user = self::find(Session::get('user_id'));
    if ($user) {
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);

      if ($request->hasFile('uimage') && $request->file('uimage')->isValid()) {
        if ($request->has('prev_img') && $user->uimage == $request['prev_img'] ) {
          if (file_exists(public_path() . '/images/' . $request['prev_img']) && $request['prev_img']!='defaul-tprofile.png') {
            unlink(public_path() . '/images/' . $request['prev_img']);
          }
          $file = $request->file('uimage');
          $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
          $request->file('uimage')->move(public_path() . '/images', $image_name);
          $img = Image::make(public_path() . '/images/' . $image_name);
          $img->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
          });
          $img->save();
        }
      } elseif ($request['rimage'] && $request->has('prev_img') && $user->uimage == $request['prev_img'] && $request['prev_img'] != 'defaul-tprofile.png') {

        if (file_exists(public_path() . '/images/' . $request['prev_img'])) {
          unlink(public_path() . '/images/' . $request['prev_img']);
        }
      } elseif ($request->has('prev_img') && $user->uimage == $request['prev_img'] && $request['prev_img'] != 'defaul-tprofile.png') {
        $image_name = $request['prev_img'];
      }

      $user->uimage = $image_name;
      $user->save();
      Session::put('user_name', $user->name);
      Session::flash('sm', 'Thank you ' . $user->name . ' your account saved successfuly');
    }
  }

  public static function getAllUserProfiles(&$data) {
    $users = DB::table('users AS u')
            ->join('user_rules AS ur', 'u.id', '=', 'ur.uid')
            ->select('u.id', 'u.name', 'u.email', 'u.created_at', 'u.updated_at', 'u.uimage', 'ur.rid')
            ->get();
    if ($users) {
      $data['users'] = $users->toArray();
    }
  }

  public static function removeFromDerictory($id) {
    $user = self::find($id);
    if ($user) {
      if (file_exists(public_path() . '/images/' . $user->uimage) && $user->uimage != "defaul-tprofile.png") {
        unlink(public_path() . '/images/' . $user->uimage);
      } else
        Session::flash('sm', 'file does not exist');
    }
  }

  public static function findUser($id) {
    $res = null;
    if (!empty($id) && is_numeric($id)) {
      $user = DB::table('users AS u')
              ->join('user_rules AS ur', 'u.id', '=', 'ur.uid')
              ->where('u.id', '=', $id)
              ->select('u.*', 'ur.rid')
              ->first();
      if ($user) {
        $res = $user;
      }
    }
    return $res;
  }

  public static function updateUser($request, $id) {
    $user = self::find($id);
    $user->name = $request['name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->save();
    $user_rule = DB::table('user_rules')
            ->where('uid', '=', $id)
            ->update(['rid' => $request['rule']]);
    Session::flash('sm','User updated successfuly');
  }

}
