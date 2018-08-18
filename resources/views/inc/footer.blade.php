<?php
$news = App\News::getNews();
?>
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-5">
        <div class="info">
          <a class="logo" href="{{url('/')}}"><img src="{{asset('/images'.'/IcomCars_logo.png')}}" alt="IcomCars"/></a>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>

        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 pre-scrollable">
        <h2>Latest technology news</h2>
        @if(!$news)
        <h4>No news available now !</h4>
        @else
        <ul class="list-unstyled">
          @foreach($news as $row)
          <li><hr>{{$row['title']}}
            <a href="{{$row['url']}}">{{$row['description']}}</a>
          </li>
          @endforeach
        </ul>
        @endif
        <p>All news from - <a href='https://newsapi.org/'> newsapi.org</a></p>    
      </div>
      <div class="contacts col-lg-3 col-md-3 col-sm-3">
        <h2>Contacts</h2>
        <p class="p-style3">
          North Industry, Ashqelon , AS,<br/>
          Kibutz Galuiot 7 street<br/>
          <a href="{{url('mailto:icomcars@gmail.com')}}">icomcars@gmail.com</a><br/>
          08 54376523 tel<br/>
          08 55523424 fax <br/>
        </p>
      </div>
    </div>
    <div class="copyright">
      <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-7">
          <p>&copy; {{date('Y')}} IcomCars. All Rights Reserved. </p>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">

        </div>
      </div>
    </div>
  </div>
</footer><!--Footer Close-->

