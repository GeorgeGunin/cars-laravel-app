@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Add content form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/content')}}" method="POST" autocomplete="off">
      @csrf
      <div class="form-group">
        <select name="menu" class="form-control">
          <option value="">choose menu...</option>
          @foreach($menus as $item)
          <option @if(old('menu') == $item["id"]) selected="selected" @endif value="{{$item['id']}}">{{$item['link']}}</option>
          @endforeach
        </select>
      </div>
     
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="mtitle" name="title" placeholder="Title" value='{{old('title')}}'>
      </div>
      
      <div class="form-group">
        <label for="article">Article</label>
        <textarea  name="article" class="form-control article">{{old('article')}}</textarea>
      </div>
      <button  name="submit" type="submit" class="btn btn-primary">Save content</button>
      <a class='btn btn-default' href='{{url('cms/content')}}'>Cancel</a>
    </form>
  </div>
</div>
@endsection

