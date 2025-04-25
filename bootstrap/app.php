<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        using: function (Illuminate\Routing\Router $router) {
            $router->middleware('web')
                ->group(base_path('routes/web.php'));

            // Add this section to load your staff routes
            $router->middleware('web') // Apply the web middleware group
                ->group(base_path('routes/staff.php')); // Load the staff route file

            // Optional: Load API routes if you have them in routes/api.php
            // $router->middleware('api')
            //        ->prefix('api')
            //        ->group(base_path('routes/api.php'));
        },

    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'staff' => \App\Http\Middleware\StaffMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
