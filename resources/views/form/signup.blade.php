@extends('.master')
@section('content')
<section class="log-reg container">
  <h2>Sign up</h2>
  <div class="row">
    <!--Login-->
    <div class="col-lg-8 col-md-8 col-sm-8">
      <form method="POST" class="login-form" action="" novalidate="">
        @csrf
        <input type="hidden" name="rule" value="7">
        <div class="form-group group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="log-email2" value="{{old('name')}}" placeholder="Enter your name" >
          <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="log-email2" value="{{old('email')}}" placeholder="Enter your email" >
          <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
        <div class="form-group group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" >
        </div>
        <div class="form-group group">
          <label for="cpassword">Password confirm</label>
          <input type="password" class="form-control" name="password_confirmation" id="cpassword" placeholder="Confirm password" >
          <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
        <input class="btn btn-success" type="submit" name="submit" value="Sign up">
       
      </form>
    </div>

  </div>
</section><!--Login / Register Close-->
@endsection