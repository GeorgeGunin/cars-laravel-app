@extends('master')
@section('content')
<!--Catalog Grid-->
@if($products)

<section class="catalog-grid" >
  <div class='row'>
    <div class='col-md-9 col-sm-6'>
      @if( $title != 'GeoCars |')
      <h1>{{ $title }}</h1>
      @endif
    </div>

    <div class="col-md-3 col-sm-6">

      <div class="btn-group">
        <button type="button" class="btn btn-primary">Sort by price</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="{{url('shop'.'/'.$products[0]->curl.'/'.'orderBy'.'/'.'high-to-low')}}">High to low</a></li>
          <li><a href="{{url('shop'.'/'.$products[0]->curl.'/'.'orderBy'.'/'.'low-to-high')}}">Low to high</a></li>
          <li role="separator" class="divider divider-primary" style="margin-top: 10px"></li>
          <li><a href="{{url('shop')}}" style="margin-top: 10px">Back to shop</a></li>
        </ul>
      </div>
    </div>

  </div>

  <div class="row">  
    <!--Tiles-->
    <div class="col-lg-9 col-md-9 col-sm-8">
      <div class="row">
        <!--Tile-->
        @foreach($products as $product)
        <div class="col-lg-6 col-md-6 col-sm-12 product">
          <div class="tile">
            <div class="badges">
              @if($product->quantity == 0)
              <span class="out"></span>
              @endif
            </div>
            <div class="price-label">${{$product->price}}</div>
            <a href="{{url('shop'.'/'.$product->curl.'/'.$product->purl)}}"><img @if($product->pimage == 'No_image_available.svg.png') style="width: 68.5%" @else style="width: 100%" @endif src="{{ asset('images'.'/'.$product->pimage) }}" alt="{{$product->ptitle}} pic"/></a>
            <div class="footer">
              <a href="{{url('shop'.'/'.$product->curl.'/'.$product->purl)}}">{{$product->ptitle}}</a>
              
              <div class="tools">

                <!--Add To Cart Button-->
                @if($product->quantity == 0)
                <span class=" btn add-cart-btn hidden"><i class="icon-shopping-cart"></i></span>
                @elseif(!Cart::get($product->id))
                <span class=" btn add-cart-btn" data-curl="{{$products[0]->curl}}"  data-id='{{$product->id}}'><span>To cart</span><i class="icon-shopping-cart"></i></span>
                @else
                <span class=" btn add-cart-btn disabled ">in<i class="icon-shopping-cart"></i></span>
                @endif
                <!--Share Button-->
                <!--Add To Wishlist Button-->

                <span class="wishlist-btn">
                  <a  href="{{url('shop').'/'.'add-to-wishlist'.'?pid='.$product->id.'&curl='.$products[0]->curl}}">
                    <div class="hover-state">Wishlist</div>
                    <i class="fa fa-plus"></i>
                  </a>
                </span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
    </div>
    <!--Filters-->
    <div class="filters-mobile col-lg-3 col-md-3 col-sm-4">
      <div class="shop-filters">

        <!--Categories Section-->
        <section class="filter-section">
          <h3>Categories</h3>
          <hr class="primary">

          <ul class="categories">
            @foreach($categories as $category)
            <li class="has-subcategory"><a href="{{url('shop'.'/'.$category['curl'])}}">{{$category['ctitle']}}</a>
              <ul class="subcategory">
                @if($all_products)
                @foreach($all_products as $product)
                @if($product['categorie_id'] == $category['id'])<li><a href="{{url('shop'.'/'.$category['curl'].'/'.$product['purl'])}}">{{$product['ptitle']}}</a></li>@endif
                @endforeach
                @endif
              </ul>
            </li>
            @endforeach
          </ul>
        </section>
        <!--Breadcrumbs-->
        <ol class="breadcrumb">
          <li><a class='btn btn-primary' href="{{url('shop')}}">Categories</a></li>
        </ol><!--Breadcrumbs Close-->
      </div>
    </div>
  </div>



</section><!--Catalog Grid Close-->



@else
<div class="row" style='min-height: 500px'>
  <div class='col-md-6' style="padding:20px">
    <p  style="font-size: 2em"><i>No products available</i></p>
  </div>
  <div class='col-md-6 text-right' style="padding:20px">
    <a href="{{url('shop')}}" class="btn btn-primary">back to categories</a>
  </div>
</div>  
@endif

@endsection