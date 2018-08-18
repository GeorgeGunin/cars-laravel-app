@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Are you sure to delete this item ?</h1>
<div class="row">
  <div class="col-md-12">
    <form method="POST" action="{{url('cms/category/'.$item_id)}}">
      @csrf
      {{ method_field('DELETE') }}
      <div class="checkbox">
        <label for='FrDb'>
          <input id="FrDb" name="FrDb" type="checkbox"> Delete data from database
        </label>
      </div>
      <input type="submit" name="submit" class="btn btn-danger" value="Delete">
      <a href="{{url('cms/category')}}" class="btn btn-default">Cancel</a>
    </form>
  </div>
</div>
@endsection

