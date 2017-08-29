<?php

namespace App\Http\Middleware;

use Closure;

class AdminzoneAccess
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
        $userRole = session()->get('userRole');
        $userIsAdmin = $userRole == 'admin';
        $userIsRedactor = $userRole == 'redactor';
        $userIsModerator = $userRole == 'moderator';

        if (!$userIsAdmin && !$userIsRedactor && !$userIsModerator) {
            if((stripos($request->path(), 'adminzone')) !== false) {
                return redirect()->route('home');
            }
            return redirect()->back();
        }

        return $next($request);
    }
}
