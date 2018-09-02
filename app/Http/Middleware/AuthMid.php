<?php

namespace App\Http\Middleware;

use Closure;

class AuthMid
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
        // echo "string";
        // echo $request->session('userid'); 
        // print_r($request->session('userid'));
        if (session('userid') == null) {
            return redirect('/login');
        }
        return $next($request);
    }
}
