
@extends('master')
@section ('content')
<!--Catalog Single Item-->
<section class="catalog-single" >
  <div class="container">
    @if(!$item)
    <div class="row nodata" style="min-height: 500px">
      <div class="col md-6">
        <p><i>No product available</i></p>
      </div>
      <div class="col md-6">
        <a class='btn btn-primary' href="{{url('shop')}}">Back to shop</a>
      </div>
    </div>
    @else
    <div class="row">

      <!--Product Gallery-->

      <div class="col-lg-6 col-md-6">
        <img style="width: 100%; height: auto;" src="{{asset('images'.'/'.$item->pimage)}}" alt="{{$item->ptitle}}.'pic'" />

        <form id="post-form" style="margin-top: 30px" method="POST" action="{{Request::url().'/feedback'}}">
          @csrf
          <input type='hidden' name='url' value='{{Session::put('url',Request::url())}}'>
          <input type='hidden' name='product_id' value='{{$item->id}}'>
          @if(!Session::has('user_id')) 
          <div class="form-group">
            <label for="feedback"><b><i>Give your feedback</i></b></label>
            <textarea disabled style="resize: none" rows="5" type="text" class="form-control" name='feedback' id="feedback" placeholder="feedback"></textarea>
           <span><p><i>for authenticated users only</i></p></span>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input type="submit"  name="submit" disabled type="submit" class="btn btn-default pull-left" value="Post">
              <a class="btn btn-success pull-right" href="{{url('user/signin')}}">sign in</a>
            </div>
          </div>
          @else
          <div class="form-group">
            <label for="fpost"><b><i>Give your feedback</i></b></label>
            <textarea  style="resize: none" rows="5" type="text" class="form-control" id="fpost" name="fpost" placeholder="feedback"></textarea>
          </div>
          
          <input id="fidpost" class="btn btn-default" type="submit" name="submit" value="Post">
          <span id="errposr" class=" class text-danger ">{{$errors->first('fpost')}}</span>
          @endif
        </form>

        <a class="btn btn-primary left" style="margin-top: 30px" href="{{url('shop').'/'.$item->category->curl}}">Back to {{$item->category->ctitle}}</a>
      </div>


      <div class="col-lg-6 col-md-6 ">
        <h1>{{$item->ptitle}}</h1>
        <div class="price">${{$item->price}}</div>
        <div class="buttons group">

          @if(!Cart::get($item->id) && $item->quantity )
          <span  class="btn btn-primary btn-sm add-cart-btn" id="addItemToCart" data-curl="{{$item->category->curl}}" data-id="{{$item->id}}"><i class="icon-shopping-cart"></i>Add to cart</span>
          @else
          <a class="btn btn-primary btn-sm add-cart-btn disabled" id="addItemToCart"><i class="icon-shopping-cart"></i>@if($item->quantity)In cart @else Out of stock @endif </a>
          @endif
      
          <a class="btn btn-success btn-sm" href="{{url('shop').'/'.'add-to-wishlist'.'?pid='.$item->id.'&curl='.$item->category->curl.'&purl='.$item->purl}}"><i class="icon-heart"></i>Add to wishlist</a>

        </div>
        <p style="text-align:justify">{!!$item->particle!!}</p>
        <div class="col-lg-12 col-md-12">
          <h4 class="page-header">Feedback's posts</h4>
          @if(!$item->posts)
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Feedback's posts</h4>
            </div>
            <div class="panel-body">
              No feedbacks available
            </div>
          </div>
          @else
          @foreach($item->posts as $post)
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$post->user->name}}</h3>
            </div>
            <div class="panel-body">
              {{$post->body}}
              @if(Session::get('user_id')== $post->user_id)
              <a href="{{url()->current().'/feedback/'.$post->id}}" class="pull-right">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
              @endif
            </div>
          </div>
         @endforeach
          {{$item->posts->links()}}
          @endif
        </div>


      </div>
    </div>

    <!--Product Description-->

  </div>
  @endif
</section><!--Catalog Single Item Close-->
@endsection