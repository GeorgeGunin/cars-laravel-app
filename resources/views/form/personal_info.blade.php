@extends('master')
@section('content')
<!--Account Personal Info-->
<section>
  <div class="container">
    <div class="row space-top">

      <!--Items List-->

      <div class="col-md-4 space-bottom">
        @if(!$user_info)
        <div class="row">
          <div class="col-md-6">
            <p><i>No Information in data </i></p>
          </div>
        </div>
        @else
        <div class="row">
          <div class="col-md-6">
            <h2 class="title">My account</h2>
          </div>
          <div class="col-md-6">
            <img src="{{ asset('images').'/'.$user_info['uimage']}}" style="width:150px;height: auto; ">
          </div>
        </div>
        <h3>Personal information</h3>

        <div class="row">

          <form class="col-md-12 personal-info" method="post" action="" novalidate="novalidate" enctype="multipart/form-data" >
            @csrf
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user_info['name']}}" >
                <span class="text-danger">{{$errors->first('name')}}</span>
                <input type="hidden" name="user" value="{{Session::get('user_id')}}">
                <input type = 'hidden' name='prev_img' value="{{$user_info['uimage']}}">
                <input type ="hidden" name="rule" value="1">
              </div>

            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{$user_info['email']}}" >
                <span class="text-danger">{{$errors->first('email')}}</span>
              </div>

            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
              </div>
            </div>

            <div class='row'>
              <div class="form-group col-sm-12">
                <label for="cpassword">Confirm password</label>
                <input type="password" class="form-control" name="password_confirmation" id="cpassword" placeholder="Confirm password">
                <span class="text-danger">{{$errors->first('password')}}</span>
              </div>
            </div>  

            <span class="btn btn-primary btn-file" >
              Browse <input class="btn btn-file subfile" type="file" name="uimage" >
            </span>
            <span id="btn-file">

            </span>
            <div class="checkbox ">
              <label for="rimage">
                <input id="rimage" name="rimage" type="checkbox"> Remove my photo
              </label>
            </div>
            <br><span class="text-danger">{{$errors->first('uimage')}}</span>

            <input type="submit" class="btn btn-success" value="Save changes" style="margin-top:10px;">
            <a class="btn btn-default" href="{{url('shop')}}" style="margin-top:10px;">Cancel</a>


          </form>
          @endif
        </div>
      </div>

      <!--Sidebar-->
      <div class="col-md-8 col-sm-12">
        <h3 align='center'>Your orders</h3>
        <div class="checkout">
          @if(!$orders)
          <h4>No orders found</h4>
          @else
          <table class='table-hover'>
            <thead>
              <tr><th></th>
                <th class='text-center'>Product</th>
                <th class='text-center'>Price</th>
                <th class='text-center'>Quantity</th>
                <th class='text-center'>Total</th>
                <th class='text-center'>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
              @foreach(unserialize($order->data) as $data)
              <tr>
                <td class='text-center'><a href="{{url('shop'.'/'.$data['attributes']['curl'].'/'.$data['attributes']['purl'])}}"><img width="120" src="{{asset('images'.'/'.$data['attributes']['pimage'])}}" alt="picture of {{$data['name']}}"/></a></td>
                <td class='text-center'>{{$data['name']}}</td>
                <td class='text-center'>{{$data['price']}}$</td>
                <td class='text-center' >{{$data['quantity']}}</td>
                <td class='text-center'>{{$data['quantity']*$data['price']}}$</td>
                <td class='text-center'>{{date('d/m/Y',strtotime($order->created_at))}}</td>  
              </tr>
              @endforeach

              @endforeach
            </tbody>
          </table>
          {{$orders->links()}}
          @endif
          <a style="margin-bottom: 30px" class="btn btn-success  space-top pull-right" href="{{url('shop')}}">Back to shop</a>
        </div>
      </div>
    </div>
  </div>
</section><!--Account Personal Info Close-->
@endsection
