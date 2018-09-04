@extends('master')
@section('content')


<!--Hero Slider-->
<section class="hero-slider">
  
  <div class="master-slider" id="hero-slider">

    <!--Slide 1-->
@foreach($new_products as $product)
    <div class="ms-slide" data-delay="7">
      <div class="overlay"></div>
      <img  src="{{asset('images').'/'.$product->bigimage}}" data-src="{{asset('images').'/'.$product->bigimage}}" alt="{{$product->ptitle.' pic'}}"/>
      <h2 style="width: 456px; left: 110px; top: 110px;" class="light-color ms-layer" data-effect="top(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">{{$product->ptitle}}</h2>
      @if($product->quantity)
      <div style="left: 110px; top: 300px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="600" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="{{url('shop').'/'.$product->curl.'/'.$product->purl}}"><span>{{$product->price}}$</span>Buy it now</a></div>
      @endif
    </div>
@endforeach
  </div>
</section><!--Hero Slider Close-->



<!--Catalog Grid-->
<section class="catalog-grid">
  <div class="container">
    <h2 class="primary-color">Catalog picks</h2>
    <div class="row center-block">
      <!--Tile-->
     @if(!$last_products)
     <div class="col-lg-12">
       <h3>No products available</h3>
     </div>
     @else
     @foreach($last_products as $l_product)
      <!--Tile-->
      <div class="col-lg-3 col-md-4 col-sm-6 center-block prod" style='padding: 10px; width:282px; height: 335px '>
        <div class="tile">
          <div class="badges">
            @if($l_product->quantity == 0)
            <span class="out"></span>
            @endif
          </div>
          <div class="price-label">{{$l_product->price}} $</div>
          
          <a href="{{url('shop').'/'.$l_product->curl.'/'.$l_product->purl}}"><img width='282'  src="{{asset('images').'/'.$l_product->pimage}}" alt="1"/></a>
          <div class="footer">
           
            <span> {{$l_product->ptitle}}</span>
            <div class="tools">
             
              <!--Add To Cart Button-->
             @if($l_product->quantity == 0)
                <span class=" btn add-cart-btn hidden"><i class="icon-shopping-cart"></i></span>
                @elseif(!Cart::get($l_product->id))
                <span style='top: 0;' class=" btn add-cart-btn" data-curl="{{$l_product->curl}}"  data-id='{{$l_product->id}}'><span>To cart</span><i class="icon-shopping-cart"></i></span>
                @else
                <span class=" btn add-cart-btn disabled ">in<i class="icon-shopping-cart"></i></span>
                @endif
              
              <!--Share Button-->
              
              <!--Add To Wishlist Button-->
              <span class="wishlist-btn">
                  <a  href="{{url('shop').'/'.'add-to-wishlist'.'?pid='.$l_product->id.'&curl='.$l_product->curl}}">
                    <div class="hover-state">Wishlist</div>
                    <i class="fa fa-plus"></i>
                  </a>
                </span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</section><!--Catalog Grid Close-->



<!--Posts/Twitter Widget-->
<section class="posts-widget">
  
  <div class="container  text-center">
    <div class="row">
      <div class="latest-posts col-lg-12 col-md-12 ">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="extra-bold">Latests feedbacks</h2>
            
          </div>
          <div class="col-lg-9">
            <!--Post-->
            @if(!$posts)
            <h3 class="page-header">No feedbacks available</h3>
            @else
            @foreach($posts as $post)
            <div class="post row">
              <div class="col-lg-6 col-sm-6">
                
                <a href="{{url('shop').'/'.$post->product->category->curl.'/'.$post->product->purl}}"><img src="{{asset('images').'/'.$post->product->pimage}}" alt="1"/></a>
              </div>
              <div class="col-lg-6 col-sm-6">
                <h3><a href="{{url('shop').'/'.$post->product->category->curl.'/'.$post->product->purl}}">{{$post->product->ptitle}}</a></h3>
                <p>{{$post->body}}</p>
                <div class="author"><i class="fa fa-user"></i>By {{$post->user->name}}</div>
              </div>
            </div>
            <!--Post End-->
            <!--Post-->
            @endforeach
            @endif
          </div>
        </div>
      </div>
     
    </div>
  </div>
</section>

<!--Gallery Widget-->


<!--Brands Carousel Widget-->






<!--Subscription Widget-->

@endsection

