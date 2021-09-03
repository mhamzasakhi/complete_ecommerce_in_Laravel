<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
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
        if (Auth::guard('customer')->check() && auth('customer')->user()->is_active) {
            return $next($request);
        }elseif (Auth::guard('customer')->check()){
            auth()->guard('customer')->logout();
        }
        Toastr::error('Unauthenticated, login first!');
        return back();
    }
}
