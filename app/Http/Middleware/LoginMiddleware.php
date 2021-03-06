<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class LoginMiddleware
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
        if (Auth::check() && (Auth::user()->level == 1 || Auth::user()->level == 2|| Auth::user()->level == 3)) {
            return $next($request);
        } else {
            return back();
        }

    }
}
