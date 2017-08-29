<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminzoneActiveSection
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
        if ((stripos($request->path(), 'adminzone/dashboard')) !== false) {
            Session::put('adminActive', 'dashboard');
        } else if ((stripos($request->path(), 'adminzone/users')) !== false) {
            Session::put('adminActive', 'users');
        } else if ((stripos($request->path(), 'adminzone/posts')) !== false) {
            Session::put('adminActive', 'posts');
        } else if ((stripos($request->path(), 'adminzone/categories')) !== false) {
            Session::put('adminActive', 'categories');
        } else if ((stripos($request->path(), 'adminzone/comments')) !== false) {
            Session::put('adminActive', 'comments');
        }
        return $next($request);
    }
}
