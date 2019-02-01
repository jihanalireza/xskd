<?php

namespace App\Http\Middleware;

use Closure;

class checksession
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
            return $next($request);
        }else{
            return redirect()->route('login.form');
        }
    }
}
