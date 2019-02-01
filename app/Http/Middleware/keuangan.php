<?php

namespace App\Http\Middleware;

use Closure;

class keuangan
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

        if ($user != "2") {

            return redirect('/');
        }
        else{
            
            return $next($request);
        }
    }
}
