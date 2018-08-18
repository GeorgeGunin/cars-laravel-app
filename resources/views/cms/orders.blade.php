
@extends('cms.cms_master')
@section('cms_content')
<h1 class="page-header">Orders </h1>

<div class='row info-tab'>
  <div class="col-md-12">
    @if(!$orders)
    <h4><i>There are no orders available</i></h4>
    @else
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Order</th>
          <th>Date</th>

        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td><img width="100" src="{{ asset('images').'/'.$order->uimage }}"></td>
          <td>{{$order->name}}</td>
          <td>
            <table class="table table-striped">
              <thead>
                <tr><th>Product</th><th>Price</th><th>Quantity</th></tr>
              </thead>
              <tbody>

                @foreach(unserialize($order->data) as $part)
                <tr class="pre-scrollable">
                  <td>{{$part['name']}} </td>
                  <td>${{$part['price']}}</td> 
                  <td>{{$part['quantity']}}</td>
                </tr>
                @endforeach
                <tr>
                  <td>Total : ${{$order->total}}</td>
                </tr>
              </tbody>
            </table>


          </td>
          <td>{{date('m/d/Y - H:i:s',strtotime($order->created_at))}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$orders->links()}}
  </div>
</div>
@endif
@endsection

