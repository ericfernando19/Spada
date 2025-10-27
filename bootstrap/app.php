<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Daftarkan alias middleware biar 'role' dikenali
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'guest.redirect' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);

        // Kalau mau tambahkan global middleware, bisa di sini juga
        // $middleware->append(\App\Http\Middleware\ExampleMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Bisa ditambahkan custom error handler di sini
    })
    ->booting(function (Application $app) {
        // ✅ Binding parameter "role" untuk validasi route
        Route::bind('role', function ($value) {
            $roles = ['admin', 'guru', 'siswa'];
            if (in_array($value, $roles)) {
                return $value;
            }

            abort(404, 'Role tidak ditemukan.');
        });
    })
    ->create();
