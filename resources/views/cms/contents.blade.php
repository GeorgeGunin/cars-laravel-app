
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Contents </h1>
<a href='{{url('cms/content/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add content</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$contents)
    <h4><i>There are no contents available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>     
          <th>Title</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($contents as $item)
        <tr>  
          <td>{{$item['title']}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($item ['updated_at']))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($item ['created_at']))}}</td>
          <td class='text-center'><a href='{{url('cms/content/'.$item['id'].'/'.'edit')}}'><span class='glyphicon glyphicon-pencil'></span></a> | <a href='{{url('cms/content'.'/'.$item['id'])}}'><span class='glyphicon glyphicon-trash' ></span></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection

