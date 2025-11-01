<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Exception $e) {
            return match (get_class($e)) {

                NotFoundHttpException::class => response()->json(['error' => 'Не найдено'], 404),

                MethodNotAllowedException::class => response()->json(['error' => "Данный метод недоступен"], 405),

                ValidationException::class => response()->json(
                    [
                        'error' => "Ошибка отправки данных",
                        'messages' => $e->errors()
                    ],
                    400
                ),


                default => response()->json(['error' => $e->getMessage()],500),
            };
        });
    })->create();
