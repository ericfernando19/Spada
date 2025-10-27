<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Jika user sudah login, arahkan ke dashboard sesuai role-nya.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Arahkan ke dashboard sesuai role
                return match ($user->role) {
                    'admin' => redirect()->route('admin.dashboard'),
                    'guru' => redirect()->route('guru.dashboard'),
                    'siswa' => redirect()->route('siswa.dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return $next($request);
    }
}
