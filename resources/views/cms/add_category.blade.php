@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add category form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/category')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      
      <div class="form-group">
        <label for="ctitle">Title</label>
        <input type="text" class="form-control dest" id="ctitle" name="ctitle" placeholder="Title" value='{{old('ctitle')}}'>
      </div>
      
       <div class="form-group">
        <label for="curl">Url</label>
        <input type="text" class="form-control target" id="curl" name="curl" placeholder="Url" value='{{old('curl')}}'>
      </div>
      
      <div class="form-group">
        <label for="img">Image</label>
        <input type="file"  id="img" name="img">
      </div>
      
      <button  name="submit" type="submit" class="btn btn-primary">Save category</button>
      <a class='btn btn-default' href='{{url('cms/category')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

