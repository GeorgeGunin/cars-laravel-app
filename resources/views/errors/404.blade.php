<?php 
$menus = App\Menu::all()->toArray();
$title = App\Http\Controllers\MainController::$data['title'];
$categories = App\Categorie::all()->toArray();
?>
@extends('master')
@section('content')
  
  <div  class="container page-404">
  	<div class="content">
    	<div class="inner">
      	<div class="block">
          <span>404</span>
        	<p>Sorry... Page not found.</p>
                <a class="btn btn-default" href="{{url('')}}">Back home</a>
          
        </div>
      </div>
    </div>
    </div>
    
@endsection

