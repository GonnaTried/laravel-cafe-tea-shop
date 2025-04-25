<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ignore this error on check() and user() it just IDE error not run time error
        if (auth()->check() || (auth()->user()->hasRole('staff'))) {
            return $next($request);
        }

        // if (auth()->check() || (auth()->user()->hasRole('admin'))) {
        //     return $next($request);
        // }
        abort(403);
    }
}
