<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // ✅ Jika belum login, arahkan ke login page
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // ✅ Jika role sesuai, lanjutkan request
        if ($user->role === $role) {
            return $next($request);
        }

        // 🚫 Jika role tidak sesuai, arahkan ke dashboard sesuai role pengguna
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => abort(403, 'Akses ditolak!'),
        };
    }
}
