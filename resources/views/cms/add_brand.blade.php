@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add brand form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/brand')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value='{{old('name')}}'>
      </div>
      
      
      <div class="form-group">
        <label for="img">Image</label>
        <input type="file" id="img" name="img">
      </div>
      
      
      <button  name="submit" type="submit" class="btn btn-primary">Save brand</button>
      <a class='btn btn-default' href='{{url('cms/brand')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

