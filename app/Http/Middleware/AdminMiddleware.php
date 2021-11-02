<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest())
        {
            return redirect()->back()->with('error','يجب ان تقوم بتسجيل الدخول أولا  .');
        }
        elseif(Auth::user()->type=='admin' ) {


            return $next($request);
        }
        abort(403);


    }
}
