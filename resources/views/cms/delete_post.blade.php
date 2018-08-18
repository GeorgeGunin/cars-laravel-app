@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Are you sure to delete this post ?</h1>
<div class="row">
  <div class="col-md-12">
    <form method="POST" action="">
      @csrf
      <input type="hidden" name="post_id" value="{{$post_id}}">
      <input type="submit" name="submit" class="btn btn-danger" value="Delete">
      <a href="{{url('cms/posts')}}" class="btn btn-default">Cancel</a>
    </form>
  </div>
</div>
@endsection

