@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add menu form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/menu')}}" method="POST" autocomplete="off">
      @csrf
      <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control dest" id="link" name="link" placeholder="Link" value='{{old('link')}}'>
      </div>
      
      <div class="form-group">
        <label for="url">Url</label>
        <input type="text" class="form-control target" id="url" name="url" placeholder="Url" value='{{old('url')}}'>
      </div>
      
      <div class="form-group">
        <label for="mtitle">Title</label>
        <input type="text" class="form-control" id="mtitle" name="mtitle" placeholder="Title" value='{{old('mtitle')}}'>
      </div>
      <button  name="submit" type="submit" class="btn btn-primary">Save link</button>
      <a class='btn btn-default' href='{{url('cms/menu')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

