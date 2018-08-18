@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add product form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/product')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <select name="category" class="form-control">
          <option value="">choose category...</option>
          @foreach($categories as $item)
          <option @if(old('category') == $item["id"]) selected="selected" @endif value="{{$item['id']}}">{{$item['ctitle']}}</option>
          @endforeach
        </select>
      </div>
     
      <div class="form-group">
        <label for="ptitle">Title</label>
        <input type="text" class="form-control dest" id="ptitle" name="ptitle" placeholder="Title" value='{{old('ptitle')}}'>
      </div>
      <div class="form-group">
        <label for="purl">Url</label>
        <input type="text" class="form-control target" id="purl" name="purl" placeholder="Url" value='{{old('purl')}}'>
      </div>
      
      <div class="form-group">
        <label for="price">Price on site</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Price">
      </div>
      
      <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
      </div>
      
      <div class="form-group">
        <label for="particle">Article</label>
        <textarea  name="particle" class="form-control article">{{old('particle')}}</textarea>
      </div>
      
      <div class="form-group">
        <label for="img">Image</label>
        <input type="file" id="img" name="img">
      </div>
      
      
      <button  name="submit" type="submit" class="btn btn-primary">Save product</button>
      <a class='btn btn-default' href='{{url('cms/product')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

