<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckPaymentStatus;
use App\Http\Middleware\Pemateri;
use App\Http\Middleware\Peserta;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //auth admin pemateri peserta class 
        $middleware->alias([
            'Admin'=> Admin::class,
            'Pemateri'=> Pemateri::class,
            'Peserta'=> Peserta::class
        ]);
 
        
    })

   
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
