@extends('.master')
@section('content')
<section class="log-reg container">
  <h2>Login</h2>
<!--  <p class="large">Use social accounts</p>
  <div class="social-login">
    <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>

  </div>-->
  <div class="row">
    <!--Login-->
    <div class="col-lg-8 col-md-8 col-sm-8">
      <form method="POST" class="login-form" action="" novalidate="">
        @csrf
        <input type="hidden" name="shoping_cart" value="{{Session::get('check')}}">
        <div class="form-group group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Enter your email" >
          <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
        <div class="form-group group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" >
          <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
        
        <input class="btn btn-success" style="padding: 10px" type="submit" name="submit" value="Login">
        <a class="btn btn-primary pull-right" style="padding: 10px" href="{{url('user'.'/'.'signup')}}">New Account</a>
        @if($errors->all() && $errors->all()[0]=='Wrong email and password')
        <span class="text-danger">{{$errors->all()[0]}}</span>
        @endif
      </form>
    </div>

  </div>
</section><!--Login / Register Close-->
@endsection