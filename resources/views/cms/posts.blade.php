
@extends('cms.cms_master')
@section('cms_content')

<h1 class="page-header">Posts </h1>

<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$posts)
    <h4><i>There are no posts available</i></h4>
    @else
    <div class="col-md-6" style="margin-bottom:30px;">
      <form class="form-inline">
        <div class="form-group">
          <label class="sr-only" for="user_name">User name</label>
          <input type="text" class="form-control" name='user_name' id="user_name" placeholder="Enter user name">
        </div>
        <div class="form-group">
          <label class="sr-only" for="title">Title</label>
          <input type="text" class="form-control" id="title" name='title' placeholder="Enter title">
        </div>
        
        <input type="submit" name='submit' class="btn btn-primary" value="Sort by">
      </form>
    </div>
    
    <table class='table table-bordered' >
      <thead>
        <tr>
          <th></th>
          <th>User Name</th>
          <th>Title</th>
          <th>Post</th>
          <th>Created at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
        <tr>
          <td><img width="50" src="{{ asset('images').'/'.$post->user->uimage }}"></td>
          <td>{{$post->user->name}}</td>
          <td>{{$post->product->ptitle}}</td>
          <td>{{$post->body}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($post->created_at))}}</td>
          <td class='text-center'><a href='{{url('cms/posts'.'/'.$post->id)}}'><span class='glyphicon glyphicon-trash' ></span></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  
</div>
@endif
@endsection

