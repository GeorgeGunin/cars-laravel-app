@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add user form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/users')}}" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate="novalidate">
      @csrf
      <div class="form-group">
        <select name="rule" class="form-control" enctype="multipart/form-data" >
          <option value="">choose rule...</option>
          <option value='6' @if(old('rule')== 6) selected="selected" @endif>Admin</option>
        <option value='7' @if(old('rule')== 7) selected="selected" @endif>User</option>
        </select>
      </div>

 <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control dest" id="name" name="name" placeholder="Name" value='{{old('name')}}'>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control target" id="email" name="email" placeholder="Email" value='{{old('email')}}'>
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

      <button  name="submit" type="submit" class="btn btn-primary">Save User</button>
      <a class='btn btn-default' href='{{url('cms/users')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

