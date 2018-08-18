
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Menus </h1>
<a href='{{url('cms/menu/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add menu</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$menus)
    <h4><i>There are no menus available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Menu</th>
          <th>Link</th>
          <th>Url</th>
          <th>Title</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($menus as $menu)
        <tr>
          <td>{{$menu['link']}}</td>
          <td>{{$menu['link']}}</td>
          <td>{{$menu['url']}}</td>
          <td>{{$menu['mtitle']}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($menu['updated_at']))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($menu['created_at']))}}</td>
          <td class='text-center'><a href='{{url('cms/menu/'.$menu['id'].'/'.'edit')}}'><span class='glyphicon glyphicon-pencil'></span></a> | <a href='{{url('cms/menu'.'/'.$menu['id'])}}'><span class='glyphicon glyphicon-trash' ></span></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection

