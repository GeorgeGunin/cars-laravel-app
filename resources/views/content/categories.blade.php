@extends('master')
@section('content')
<!--Categories-->

<section class="cat-tiles" style='min-height: 500px'>
  <div class="container-fluid">
    <h2>Browse categories</h2>
    
    <div class="row">
      <!--Category-->
      @foreach($categories as $category)
      <div class="category col-md-4 col-sm-6 col-xs-12">
        <a href="{{url('shop'.'/'.$category['curl'])}}">
          <img  src="{{ asset('images'.'/'.$category['cimage']) }}" alt="{{$category['cimage']}}"/>
          <p>{{$category['ctitle']}}</p>
        </a>
      </div>
      @endforeach
    </div>
    
   
  </div>
  
</section><!--Categories Close-->

@endsection

