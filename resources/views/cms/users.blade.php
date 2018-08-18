
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Users </h1>
<a href='{{url('cms/users/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add user</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$users)
    <h4><i>There are no user available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Image</th>
          <th>User Name</th>
          <th>Rule</th>
          <th>Email</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td><img width="50" src="{{ asset('images').'/'.$user->uimage }}"></td>
          <td>{{$user->name}}</td>
          <td>@if($user->rid == 6)Admin @else User @endif</td>
          <td>{{$user->email}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($user->created_at))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($user->updated_at))}}</td>
          <td class='text-center'>
            <a href='{{url('cms/users/'.$user->id.'/'.'edit')}}'>
              <span class='glyphicon glyphicon-pencil'></span></a> | 
              <a href='{{url('cms/users'.'/'.$user->id)}}'>
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

