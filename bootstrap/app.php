<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\OnlyAdminMiddleware;
use App\Http\Middleware\OnlyCustomerMiddleware;
use App\Http\Middleware\OnlyBoatownerMiddleware;
use App\Http\Middleware\EnsureAjaxRequest;
use App\Http\Middleware\SetLang;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'onlyAdmin' => OnlyAdminMiddleware::class,
            'onlyCustomer' => OnlyCustomerMiddleware::class,
            'onlyBoatowner' => OnlyBoatownerMiddleware::class,
            'ajax' => EnsureAjaxRequest::class,
            'Setlang' => SetLang::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
