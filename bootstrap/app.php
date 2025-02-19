<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Middleware\OnlyCustomerMiddleware;
use App\Http\Middleware\OnlyBoatownerMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'onlyAdmin' => OnlyAdminMiddleware::class,
            'onlyCustomer' => OnlyCustomerMiddleware::class,
            'onlyBoatowner' => OnlyBoatownerMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
