<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'ajax-request' => \App\Http\Middleware\AjaxRequest::class,
            'redirect-if-authenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Add alias
            'counter-statistik' => \App\Http\Middleware\CounterStatistik::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
