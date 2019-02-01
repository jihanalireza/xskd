<?php

namespace App\Http\Middleware;

use Closure;

class guru
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
        $user = session()->get('role')['id_role'];        

        if ($user != "5") {

            return redirect('/');
        }
        else{
            return $next($request);
        }
    }
}
