<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class APILocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = ($request->hasHeader('lang')) ? (strlen($request->header('lang')) > 0 ? $request->header('lang') : 'en') : 'en';
        App::setLocale($local);
        return $next($request);
    }
}
