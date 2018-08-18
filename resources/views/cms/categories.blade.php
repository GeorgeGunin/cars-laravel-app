
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Categories </h1>
<a href='{{url('cms/category/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add category</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$categories)
    <h4><i>There are no categories available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Image</th>
          <th>Title</th>
          <th>Url</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td><img width="150" src="{{ asset('images').'/'.$category['cimage'] }}"></td>
          <td>{{$category['ctitle']}}</td>
          <td>{{$category['curl']}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($category['created_at']))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($category['updated_at']))}}</td>
          <td class='text-center'><a href='{{url('cms/category/'.$category['id'].'/'.'edit')}}'><span class='glyphicon glyphicon-pencil'></span></a> | <a href='{{url('cms/category'.'/'.$category['id'])}}'><span class='glyphicon glyphicon-trash' ></span></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection

