@extends('master')
@section('content')
<section class="catalog-single" style='min-height: 500px'>
  <div class="container">
  @if($contents)
  @foreach($contents as $content)
  <h2>{{$content->title}}</h2>
  <p>{!!$content->article!!}</p>
  @endforeach
  @else
  <p><i>No content available</i></p>
 </div>
 @endif
</section>
@endsection

