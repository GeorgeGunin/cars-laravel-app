@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Edit user form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/users').'/'.$item->id}}" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate="novalidate">
      @csrf
      {{method_field('PUT')}}
<!--      <input type = 'hidden' name='prev_img' value="{{$item->uimage}}" >-->
      <div class="form-group">
        <select name="rule" class="form-control">
          <option value="">choose rule...</option>
          <option value='6' @if($item->rid == 6) selected="selected" @endif >Admin</option>
          <option value='7'@if($item->rid == 7) selected="selected" @endif  >User</option>
        </select>
      </div>

 <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control dest" id="name" name="name" placeholder="Name" value='{{$item->name}}'>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control target" id="email" name="email" placeholder="Email" value='{{$item->email}}'>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>


      <div class="form-group">
        <label for="cpassword">Confirm password</label>
        <input type="password" class="form-control" name="password_confirmation" id="cpassword" placeholder="Confirm password">
        <span class="text-danger">{{$errors->first('password')}}</span>
      </div>

      <button  name="submit" type="submit" class="btn btn-primary">Edit User</button>
      <a class='btn btn-default' href='{{url('cms/users')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

