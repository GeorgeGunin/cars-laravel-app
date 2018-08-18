
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$title}} Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('').'/'.'images'.'/'.'IcomCars_logo.png'}}">
    <!--Jquery UI-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('/css/mystyle.css')}}" rel="stylesheet" type="text/css"/>
    <script>var BASE_URL = "{{url('')}}/"</script>
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div style='padding: 5px;' class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style='padding: 5px;' class="logo" href="{{url('')}}"><img id='nav-logo' src="{{asset('/images'.'/IcomCars_logo.png')}}" alt="IcomCars"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{url('cms/dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('user/logout')}}">Logout</a></li>
            <li><a href="{{url('')}}" target="_blank">Back to home</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div style='margin-top: 20px' class="container-fluid"> 
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="{{url('cms/dashboard')}}">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="{{url('cms/orders')}}"> <span data-feather="file-text"></span>Orders</a></li>
            <li><a href="{{url('cms/users')}}"> <span data-feather="users"></span>Users</a></li>
            <li><a href="{{url('cms/posts')}}"> <span data-feather="message-circle"></span>Posts</a></li>
            <li><a href="{{url('cms/product')}}"> <span data-feather="gift"></span>Products</a></li>
            <li><a href="{{url('cms/brand')}}"> <span data-feather="award"></span>Brands</a></li>
            <li><a href="{{url('cms/category')}}"> <span data-feather="box"></span>Categories</a></li>
            <li><a href="{{url('cms/menu')}}"> <span data-feather="briefcase"></span>Menus</a></li>
            <li><a href="{{url('cms/content')}}"> <span data-feather="book-open"></span>Contents</a></li>

          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          @if(Session::has('sm'))
          <div class="row message">
            <div class='col-md-12 '>
              <div class="alert alert-success text-center" role="alert">
                <p>{{Session::get('sm')}}</p>
              </div>
            </div>
          </div>
          @endif
          <div>
            @if($errors->any())
            <div class=" alert alert-danger text-center message" role="alert">
              @foreach($errors->all() as $error)
              <p>{{$error}}</p>
              @endforeach
            </div>

            @endif
          </div>
          @yield('cms_content')
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script>
      feather.replace();
    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>




  </body>
</html>
