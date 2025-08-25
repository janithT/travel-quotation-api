<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/',

        commands: __DIR__.'/../routes/console.php',

        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
           $className = get_class($e);
            $handlers = App\Exceptions\Handler::$handlers;

            if (array_key_exists($className, $handlers)) {
                $method = $handlers[$className];
                $apiHandler = new App\Exceptions\Handler(app());
                return $apiHandler->$method($e, $request);
            }
 
            return apiResponseWithStatusCode([], 'error', $e->getMessage(), '', 422);

        });
    })->create();
