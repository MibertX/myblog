<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ActiveSection
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
        if ((stripos($request->path(), 'adminzone')) !== false) {
            Session::put('active', 'adminzone');
        } else if ((stripos($request->path(), 'articles')) !== false) {
            Session::put('active', 'blog');
        } else if ($request->path() == '/') {
            Session::put('active', 'main');
        }

        return $next($request);
    }
}
