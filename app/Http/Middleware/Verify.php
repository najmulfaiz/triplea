<?php

namespace App\Http\Middleware;

use Closure;
use App\LoginMember;

class Verify
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
        if (session('userid') != null) {
            $user = LoginMember::where('id',session('userid'))->first();
            if ($user->status ==0) {
            return redirect('/dashboard');
            }
        return $next($request);
        }
        return $next($request);
    }
}
