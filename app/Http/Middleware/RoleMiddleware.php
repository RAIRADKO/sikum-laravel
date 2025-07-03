<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Jika user belum login, redirect ke halaman login.
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek apakah level user ada di dalam daftar roles yang diizinkan.
        if (in_array($user->level, $roles)) {
            return $next($request);
        }

        // Jika tidak memiliki akses, tampilkan halaman 403 Forbidden.
        abort(403, 'ANDA TIDAK MEMILIKI AKSES');
    }
}