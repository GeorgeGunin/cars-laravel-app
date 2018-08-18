
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Brands </h1>
<a href='{{url('cms/brand/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add Brand</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$brands)
    <h4><i>There are no brands available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($brands as $brand)
        <tr>
          <td><img width="100" src="{{ asset('images').'/'.$brand['bimage'] }}"></td>
          <td>{{$brand['name']}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($brand['created_at']))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($brand['updated_at']))}}</td>
          <td class='text-center'>
            <a href='{{url('cms/brand/'.$brand['id'].'/'.'edit')}}'>
              <span class='glyphicon glyphicon-pencil'></span></a> | 
              <a href='{{url('cms/brand'.'/'.$brand['id'])}}'>
                <span class='glyphicon glyphicon-trash' ></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection

