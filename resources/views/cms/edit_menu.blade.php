@extends('cms.cms_master')
@section('cms_content')
@if(!$item)
<h1 class="page-header">No menu available </h1>
<a class="btn btn-default" href='{{url('cms/menu')}}'>Back to menus</a>
@else
<h1 class="page-header">Edit menu form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/menu').'/'.$item['id']}}" method="POST" autocomplete="off">
      @csrf
      {{ method_field('PUT') }}
      <input type='hidden' name="item_id" value="{{$item['id']}}">
     
      <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control dest" id="link" name="link" placeholder="Link" value='{{$item['link']}}'>
      </div>
      
      <div class="form-group">
        <label for="url">Url</label>
        <input type="text" class="form-control target" id="url" name="url" placeholder="Url" value='{{$item['url']}}'>
      </div>
      
      <div class="form-group">
        <label for="mtitle">Title</label>
        <input type="text" class="form-control" id="mtitle" name="mtitle" placeholder="Title" value='{{$item['mtitle']}}'>
      </div>
      <button  name="submit" type="submit" class="btn btn-primary">Edit link</button>
      <a class='btn btn-default' href='{{url('cms/menu')}}'>Cancel</a>
    </form>
  </div>
</div>
@endif
@endsection

