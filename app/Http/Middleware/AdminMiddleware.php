<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle($request, Closure $next,$guard = null)
    {
        if(auth()->check()){
            if (Auth::guard($guard)->check() && Auth::user()->admin == 1) {
                return $next($request);
            }
        }
        return redirect()->route('index');
    }
}
