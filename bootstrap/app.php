<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'IsAdmin' => \App\Http\Middleware\CheckAdmin::class,
            'hasInterestsAndType' => \App\Http\Middleware\CheckAccountTypeAndInterests::class,
            'hasUsername' => \App\Http\Middleware\CheckUsername::class,
            'verified' => \App\Http\Middleware\CheckVerifiedUser::class,
            'setLocale' => \App\Http\Middleware\SetLocale::class,
            'enhanced.profile' => \App\Http\Middleware\CheckEnhancedProfile::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


