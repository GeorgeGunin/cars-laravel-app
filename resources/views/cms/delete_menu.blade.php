@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Are you sure to delete this item ?</h1>
<div class="row">
  <div class="col-md-12">
    <form method="POST" action="{{url('cms/menu/'.$item_id)}}">
      @csrf
      {{ method_field('DELETE') }}
      <input type="submit" name="submit" class="btn btn-danger" value="Delete">
      <a href="{{url('cms/menu')}}" class="btn btn-default">Cancel</a>
    </form>
  </div>
</div>
@endsection

