@extends('master')
@section('content')
<section class="wishlist">
  <div class="container">
    <div class="row">
      @if(!$whishlist)
      <div class="col-md-9">
        <p><i>Whish list is empty</i></p>
      </div>
      @else
      <!--Items List-->
      <div class="col-lg-9 col-md-9">
        <h2 class="title">Wishlist</h2>
        <table class="items-list">
          <tr>
            <th>&nbsp;</th>
            <th>Product name</th>
            <th>Product price</th>
          </tr>
          <!--Item-->
          @foreach($whishlist as $item)
          <tr class="item first">
            <td class="thumb"><a href="{{url('shop').'/'.$item['curl'].'/'.$item['purl']}}"><img src="{{ asset('images').'/'.$item['pimage'] }}" alt="{{$item['ptitle']}}"/></a></td>
            <td class="name"><a href="{{url('shop').'/'.$item['curl'].'/'.$item['purl']}}">{{$item['ptitle']}}</a></td>
            <td class="price">{{$item['price']}}$</td>
            <td class="button">

              @if(!Cart::get($item['pid']))
              <span class="btn btn-primary btn-sm add-cart-btn" id="addItemToCart" data-curl="{{$item['curl']}}" data-id="{{$item['pid']}}"><i class="icon-shopping-cart"></i>Add to cart</span>
              @else
              <a class="btn btn-primary btn-sm add-cart-btn disabled" id="addItemToCart"><i class="icon-shopping-cart"></i>In cart</a>
              @endif

            </td>
            <td class="delete"><a href="{{url('shop/delete-from-wishlist').'?pid='.$item['pid'].'&uid='.$item['uid']}}"><i class="icon-delete"></i></a></td>
          </tr> 
          @endforeach
        </table>
      </div>
@endif
      <!--Sidebar-->
      <div class="col-md-3" style="padding-bottom: 30px; padding-top: 30px">

        
        <a class="btn btn-sm btn-block btn-primary" href="{{url('shop')}}">Back to shop</a>
        <a class="btn btn-sm btn-block btn-default" href="{{url('shop'.'/'.'clear-whishlist'.'?uid='.Session::get('user_id'))}}">Clear wishlist</a>
      </div>
    </div>
    
  </div>
</section><!--Wishlist Close-->
@endsection

