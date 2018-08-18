<?php

namespace App;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  public static function getNews(){
     $url="https://newsapi.org/v2/top-headlines?country=us&category=technology&apiKey=656d9475c1fb4f01bb07458b3f2b3234";
     $response = Curl::to($url)->get();
     $response = json_decode($response,true);
     return  $response['articles'] ;
  }
  
}
