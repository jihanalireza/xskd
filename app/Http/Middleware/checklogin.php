<?php

namespace App\Http\Middleware;

use Closure;

class checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('token')){
            return redirect('/');
        }else{
            return $next($request);
        }
    }
}
