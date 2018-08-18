@extends('cms.cms_master')
@section('cms_content')
@if(!$item)
<h1 class="page-header">No category available </h1>
<a class="btn btn-default" href='{{url('cms/category')}}'>Back to categories</a>
@else
<h1 class="page-header">Edit category form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/category').'/'.$item['id']}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <input type='hidden' name="item_id" value="{{$item['id']}}">
     
      <div class="form-group">
        <label for="ctitle">Title</label>
        <input type="text" class="form-control dest" id="ctitle" name="ctitle" placeholder="Title" value='{{$item['ctitle']}}'>
      </div>
      
      <div class="form-group">
        <label for="curl">Url</label>
        <input type="text" class="form-control target" id="curl" name="curl" placeholder="Url" value='{{$item['curl']}}'>
      </div>
      
      <input type='hidden' name='current_img' value="{{$item['cimage']}}">
      
      <div class="form-group">
        <label for="img"><img width="100" src="{{ asset('images').'/'.$item['cimage'] }}"></label>
        <input type="file"  id="img" name="img">
      </div>
      @if($item['cimage']!='No_image_available.svg.png')
       <div class="checkbox">
        <label for='FrDb'>
          <input id="FrDb" name="FrDb" type="checkbox"> Delete current image from file system
        </label>
      </div>
      @endif
      <button  name="submit" type="submit" class="btn btn-primary">Edit category</button>
      <a class='btn btn-default' href='{{url('cms/category')}}'>Cancel</a>
    </form>
  </div>
</div>
@endif
@endsection

