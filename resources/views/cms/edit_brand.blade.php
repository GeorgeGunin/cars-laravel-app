@extends('cms.cms_master')
@section('cms_content')
@if(!$item)
<h1 class="page-header">No brand available </h1>
<a class="btn btn-default" href='{{url('cms/brand')}}'>Back to brands</a>
@else
<h1 class="page-header">Edit brand form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/brand').'/'.$item['id']}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <input type='hidden' name="item_id" value="{{$item['id']}}">
     
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control " id="name" name="name" placeholder="Brand Name" value='{{$item['name']}}'>
      </div>
      
      <input type='hidden' name='current_img' value="{{$item['bimage']}}">
      <div class="form-group">
        <label for="img"><img width="100" src="{{ asset('images').'/'.$item['bimage'] }}"></label>
        <input type="file"  id="img" name="img">
      </div>
      @if($item['bimage']!='No_image_available.svg.png')
       <div class="checkbox">
        <label for='FrDb'>
          <input id="FrDb" name="FrDb" type="checkbox"> Delete current image from file system
        </label>
      </div>
      @endif
      <button  name="submit" type="submit" class="btn btn-primary">Edit brand</button>
      <a class='btn btn-default' href='{{url('cms/brand')}}'>Cancel</a>
    </form>
  </div>
</div>
@endif
@endsection

