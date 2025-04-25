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
        if (auth()->check() && (auth()->user()->hasRole('staff') || auth()->user()->hasRole('admin'))) {
            // User is authenticated AND has either staff or admin role, proceed
            return $next($request);
        }

        // If the above condition is NOT met, deny access
        abort(403, 'Unauthorized access.');

        // if (!auth()->check() || !auth()->user()->hasRole('admin')) {
        //     abort(403);
        // }
        // return $next($request);
    }
}
