<?php

namespace App\Http\Middleware;

use Closure;

class ExistViewMiddleware
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
        if (!view()->exists($request->path())) {
            abort(404);
        }
        
        return $next($request);
    }
}
