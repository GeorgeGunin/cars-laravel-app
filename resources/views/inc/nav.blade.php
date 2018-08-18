<!--Login Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h2>Login or <a href="register.html">Register</a></h2>
        <p class="large">Use social accounts</p>
        <div class="social-login">
          <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
          <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
          <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>
        </div>
      </div>
      <div class="modal-body">
        <form class="login-form">
          <div class="form-group group">
            <label for="log-email">Email</label>
            <input type="email" class="form-control" name="log-email" id="log-email" placeholder="Enter your email" required>
            <a class="help-link" href="#">Forgot email?</a>
          </div>
          <div class="form-group group">
            <label for="log-password">Password</label>
            <input type="text" class="form-control" name="log-password" id="log-password" placeholder="Enter your password" required>
            <a class="help-link" href="#">Forgot password?</a>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
          <input class="btn btn-success" type="submit" value="Login">
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Header-->
<header data-offset-top="500" data-stuck="600"><!--data-offset-top is when header converts to small variant and data-stuck when it becomes visible. Values in px represent position of scroll from top. Make sure there is at least 100px between those two values for smooth animation-->

  <!--Search Form-->
  <form class="search-form closed" action="{{url('words/means')}}" method="POST" autocomplete="off">
    @csrf
    <div class="container">
      <div class="close-search"><i class="icon-delete"></i></div>
      <div class="form-group">
        <label class="sr-only" for="search" name="search">Search for procuct</label>
        <input  type="text" class="form-control" name="search" id="search" value="{{old('search')}}">
        <button  type="submit" name="submit"><i class="icon-magnifier"></i></button>
      </div>
    </div>
  </form>

  <!--Split Background-->
  <div class="left-bg"></div>
  <div class="right-bg"></div>

  <div class="container">
     <a class="logo" href="{{url('')}}"><img id='nav-logo' src="{{asset('/images'.'/IcomCars_logo.png')}}" alt="IcomCars"/></a>
    <!--Mobile Menu Toggle-->
    <div class="menu-toggle"><i class="fa fa-list"></i></div>
    <div class="mobile-border"><span></span></div>

    <!--Main Menu-->
    <nav class="menu">
      <ul class="main">
        <li class="has-submenu"><a href="{{url('')}}">Home<i class="fa fa-chevron-down"></i></a><!--Class "has-submenu" for proper highlighting and dropdown-->
          @if($menus)
          <ul class="submenu">
            @foreach($menus as $menu)
            <li><a href="{{url('').'/'.$menu['url']}}">{{$menu['link']}}</a></li>
            @endforeach
          </ul>
          @endif
        </li>
        <li @if(@categories)class="has-submenu"@endif><a href="{{url('shop')}}">Shop<i class="fa fa-chevron-down"></i></a>                 
          <ul class="submenu">
            @foreach($categories as $category) 
            <li><a href="{{url('shop'.'/'.$category['curl'])}}">{{$category['ctitle']}}</a></li>
            @endforeach
          </ul>
        </li>
        @if(Session::has('user_id'))
        <li class='has-submenu'><a href="{{url('user').'/'.'profile'}}">{{Session::get('user_name')}}<i class="fa fa-chevron-down"></i></a>
          <ul class='submenu'>
            <li><a href="{{url('user').'/'.'profile'}}">User Profile</a></li>
          </ul>
          @if(Session::has('is_admin'))
        <li><a href="{{url('cms/dashboard')}}">Admin panel</a> </li>
          @endif
          @endif
         @if(@menus)
          @foreach($menus as $menu)
          <li><a href='{{url('').'/'.$menu['url']}}'>{{$menu['link']}}</a></li>
          @endforeach
          @endif
      </ul>

    </nav>



    <!--Toolbar-->
    <div class="toolbar group">
      <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>
      <div class="middle-btns">
        <a class="btn-outlined-invert" href="{{url('shop').'/'.'wish-list'}}"><i class="icon-heart"></i> <span>Wishlist</span></a>
        @if(!Session::has('user_id'))
        <a class="login-btn btn-outlined-invert" href="{{url('user').'/'.'signin'}}" ><i class="icon-profile"></i> <span>Sign in</span></a>
        @else
        <a  class="login-btn btn-outlined-invert" href="{{url('user').'/'.'logout'}}" ><i class="icon-profile"></i> <span>Logout</span></a>
        @endif
      </div>

      <div class="cart-btn">
        <a class="btn btn-outlined-invert" href="{{url('shop'.'/'.'shopping-cart')}}"><i class="icon-shopping-cart-content"></i><span>{{Cart::getTotalQuantity()}}</span></a>
        <!--Cart Dropdown-->

      </div>


    </div><!--Toolbar Close-->


  </div>

</header><!--Header Close-->


