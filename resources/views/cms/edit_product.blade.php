@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Edit product form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/product').'/'.$item['id']}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
       {{ method_field('PUT') }}
       <input type='hidden' name='item_id' value='{{$item['id']}}'>
      <div class="form-group">
        <select name="category" class="form-control">
          <option value="">choose category...</option>
          @foreach($categories as $category)
          <option @if($category['id'] == $item["categorie_id"]) selected="selected" @endif value="{{$item['categorie_id']}}">{{$category['ctitle']}}</option>
          @endforeach
        </select>
      </div>
     
      <div class="form-group">
        <label for="ptitle">Title</label>
        <input type="text" class="form-control dest" id="ptitle" name="ptitle" placeholder="Title" value='{{$item['ptitle']}}'>
      </div>
      <div class="form-group">
        <label for="purl">Url</label>
        <input type="text" class="form-control target" id="purl" name="purl" placeholder="Url" value='{{$item['purl']}}'>
      </div>
      
      <div class="form-group">
        <label for="price">Price on site</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value='{{$item['price']}}'>
      </div>
       
       <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{$item['quantity']}}">
      </div>
      
      <div class="form-group">
        <label for="particle">Article</label>
        <textarea  name="particle" class="form-control article">{!!$item['particle']!!}</textarea>
      </div>
      
      <div class="form-group">
        <label for="img"><image width='100' src='{{ asset('images').'/'.$item['pimage'] }}'></label>
        <input type="file" id="img" name="img">
      </div>
       
       <input type='hidden' name='current_img' value="{{$item['pimage']}}">
       <input type='hidden' name='currentbig_img' value="{{$item['bigimage']}}">
      
       @if($item['pimage']!='No_image_available.svg.png')
       <div class="checkbox">
        <label for='FrDb'>
          <input id="FrDb" name="FrDb" type="checkbox"> Delete current image from file system
        </label>
      </div>
      @endif
      
      <button  name="submit" type="submit" class="btn btn-primary">Edit product</button>
      <a class='btn btn-default' href='{{url('cms/product')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

