
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Categories </h1>
<a href='{{url('cms/product/create')}}' class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span>Add product</a>
<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$all_products)
    <h4><i>There are no products available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Image</th>
          <th>Title</th>
          <th>Price</th>
          <th>In Stock</th>
          <th>Url</th>
          <th>Created at</th>
          <th>Updated at at</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($all_products as $product)
        <tr>
          <td><img width="150" src="{{ asset('images').'/'.$product['pimage'] }}"></td>
          <td>{{$product['ptitle']}}</td>
          <td>${{$product['price']}}</td>
          <td class="text-center">
           
             
            <div class='btn btn-primary stock_up' data-id="{{$product['id']}}" data-op='plus' style="width: 100%" >+</div>
            <div  style="width: 100%"><input class='text-center' type="text" name='text' size="2" value='{{$product['quantity']}}'></div>
            <div class='btn btn-primary stock_up' data-id="{{$product['id']}}" data-op='minus' style="width: 100%" >-</div>
            
            
          </td>
          <td>{{$product['purl']}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($product['created_at']))}}</td>
          <td>{{date('m/d/Y - H:i:s',strtotime($product['updated_at']))}}</td>
          <td class='text-center'>
            <a href='{{url('cms/product/'.$product['id'].'/'.'edit')}}'>
              <span class='glyphicon glyphicon-pencil'></span></a> | 
              <a href='{{url('cms/product'.'/'.$product['id'])}}'>
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

