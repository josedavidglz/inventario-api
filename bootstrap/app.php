<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
         $exceptions->render(function (AuthorizationException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'code'    => 403,
                'message' => 'No tienes permiso para acceder a este recurso.',
            ], 403);
        });

        $exceptions->render(function (AuthenticationException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'No estás autenticado.',
            ], 401);
        });

        // Opcional: manejar otros HttpException
        $exceptions->render(function (HttpExceptionInterface $e, $request) {
            return response()->json([
                'status'  => 'error',
                'code'    => $e->getStatusCode(),
                'message' => $e->getMessage() ?: 'Error de servidor.',
            ], $e->getStatusCode());
        });

    })->create();
