<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthGuard {

  public function handle($request, Closure $next) {
    
    if(Session::has('user_id')){
      return redirect('');
   }
    return $next($request);
  }

}
