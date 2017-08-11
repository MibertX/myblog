<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
        if(!session()->has('locale') || !in_array(session('locale'), config('app.languages'))) {
            session()->set('locale', \Request::getPreferredLanguage( config('app.languages') ));
        }

        app()->setLocale(session('locale'));

        return $next($request);
    }
}
