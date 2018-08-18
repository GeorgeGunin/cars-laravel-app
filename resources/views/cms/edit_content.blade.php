@extends('cms.cms_master')
@section('cms_content')
@if(!$item)
<h1 class="page-header">No content available </h1>
<a class="btn btn-default" href='{{url('cms/menu')}}'>Back to contents</a>
@else
<h1 class="page-header">Edit content form </h1>
<div class='row'>
  <div class='col-md-8'>
    <form action="{{url('cms/content').'/'.$item['id']}}" method="POST" autocomplete="off">
      @csrf
      {{ method_field('PUT') }}
      
      <div class="form-group">
        <select name="menu" class='form-control'>
          <option value="">choose menu...</option>
          @foreach($menus as $menu)
          <option @if($menu["id"] == $item["menu_id"]) selected="selected" @endif value="{{$item['menu_id']}}">{{$menu['link']}}</option>
          @endforeach
        </select>
      </div>
      
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control dest" id="title" name="title" placeholder="Title" value='{{$item['title']}}'>
      </div>
      
      <div class="form-group">
        <label for="article">Article</label>
        <textarea id='article' class="article" name='article'>{!!$item['article']!!}</textarea>
      </div>
      
      
      <button  name="submit" type="submit" class="btn btn-primary">Edit content</button>
      <a class='btn btn-default' href='{{url('cms/content')}}'>Cancel</a>
    </form>
  </div>
</div>
@endif
@endsection

