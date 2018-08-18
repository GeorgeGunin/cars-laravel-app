
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('').'/'.'images'.'/'.'IcomCars_logo.png'}}">
    <!--SEO Meta Tags-->
    <meta name="description" content="Responsive HTML5 E-Commerce Template" />
    <meta name="keywords" content="responsive html5 template, e-commerce, shop, bootstrap 3.0, css, jquery, flat, modern" />
    <meta name="author" content="8Guild" />
    @inject(data,'App\Service\Data')


    <!--Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--Master Slider Styles-->
    <link href="{{ asset('lib/bushido/masterslider/style/masterslider.css') }}" rel="stylesheet" media="screen">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <!--Styles-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('lib/bushido/css/styles.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet" type="text/css"/>

    <!--Modernizr-->
    <script src="{{ asset('lib/bushido/js/libs/modernizr.custom.js') }}"></script>
    <script>var BASE_URL = "{{url('')}}/"</script>
    <!--Adding Media Queries Support for IE8-->
    <!--[if lt IE 9]>
      <script src="lib/bushido/js/plugins/respond.js"></script>
    <![endif]-->
  </head>

  <!--Body-->
  <body>

    @include('inc.nav')

    <!--Page Content-->
    <div class="page-content"> 
      <div class='row'>
        <div class='col-md-12'>
          @include('inc.sm')
        </div>
        
      </div>
    </div>
    
    @yield('content')
   
  </div><!--Page Content Close-->
  <!--Footer-->
  <!--Sticky Buttons-->
  <div class="sticky-btns">
    <span id="scrollTop-btn"><i class="fa fa-chevron-up"></i></span>
  </div><!--Sticky Buttons Close-->
  <section class="brand-carousel">
    <div class="container">
      <h2>Brands in our shop</h2>
      <div class="inner">
        @if(!$data->brand)
        <div class='row'>
          <div class="col-md-12">
            <h4>There are no brands available</h4>
          </div>
        </div>
        @else
        @foreach($data->brand as $brand)
        <a class="item" href="#"><img src="{{asset('images').'/'.$brand['bimage']}}" alt="{{$brand['name'].'pic'}}"/></a>
        @endforeach
        @endif
      </div>
    </div>
  </section><!--Brands Carousel Close-->
  @include('inc.footer')

  <!--Javascript (jQuery) Libraries and Plugins-->
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="{{ asset('lib/bushido/js/libs/jquery-1.11.1.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/libs/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/icheck.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/jquery.placeholder.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/jquery.touchSwipe.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/jquery.shuffle.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/lightGallery.min.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script src="{{ asset('lib/bushido/js/plugins/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/plugins/masterslider.min.js') }}"></script>
  <script src="{{ asset('lib/bushido/mailer/mailer.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/scripts.js') }}"></script>
  <script src="{{ asset('lib/bushido/js/404.js') }}"></script>

 
  
  <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
</body><!--Body Close-->
</html>


