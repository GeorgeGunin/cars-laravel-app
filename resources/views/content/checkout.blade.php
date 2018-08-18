@extends('master')
@section('content')
<section class="shopping-cart">
  <div class="container">

    <div class="row">
      <!--Items List-->
      <div class="col-lg-9 col-md-9">
        <h2 class="title">Shopping cart</h2>
        @if(!$incart) 

        <p>Cart is empty</p>

      </div>
      @else 
      <table class="items-list">
        <tr>
          <th>&nbsp;</th>
          <th>Product name</th>
          <th>Product price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
        <!--Item-->
        @foreach($incart as $item)
        <tr class="item first">
          <td class="thumb">
            <a href="{{url('shop'.'/'.$item['attributes']['curl'].'/'.$item['attributes']['purl'])}}"><img src="{{asset('images'.'/'.$item['attributes']['pimage'])}}" alt="picture of {{$item['name']}}"/></a>
            <p><b>Products in stock</b><span class='badge bg-primary'>{{$item['attributes']['quantity']}}</span><p>
          </td>
          <td class="name">{{$item['name']}}</td>
          <td class="price">{{$item['price']}} $</td>
          <td class="qnt-count">
            
            <span class="incr-btn"  class="hidden"  data-id="{{$item['id']}}" data-op="minus">-</span>
            <input name="quantity" class="quantity form-control" type="text" value="{{$item['quantity']}}">
            <span @if($item['attributes']['quantity'] - $item['quantity'])class="incr-btn" @else class="hidden" @endif data-id="{{$item['id']}}" data-op="plus">+</span>
          </td>
          <td class="total">{{$item['price']*$item['quantity']}} $</td>
          <td class="delete"><a href="{{url('shop'.'/'.'item-delete'.'?id='.$item['id'])}}"><i class="icon-delete"></i></a></td>
        </tr>
        @endforeach
      </table>
    </div>
 @endif
    <!--Sidebar-->
    <div class="col-lg-3 col-md-3" style="margin-bottom:40px">
      <h3>Cart totals</h3>
      
        <div class="cart-totals">
          <table>
            @foreach($incart as $item)
            <tr>
              <td>Cart subtotal</td>
              <td class="total align-r">{{$item['price']*$item['quantity']}} $</td>
            </tr>
            @endforeach
            
            <tr>
              <td>Order total</td>
             <td class="total align-r">{{Cart::getTotal()}} $</td>
            </tr>
          </table>
          <a href="{{url('shop'.'/'.'order')}}" class="btn btn-success btn-block" >Order</a>
          <a class="btn btn-sm btn-block btn-primary" href="{{url('shop')}}">Back to shop</a>
           <a class="btn btn-sm btn-block btn-default" href="{{url('shop'.'/'.'clear-cart')}}">Clear cart</a>
        </div>

     
    </div>
   
  </div>
</div>
</section><!--Shopping Cart Close-->
@endsection
