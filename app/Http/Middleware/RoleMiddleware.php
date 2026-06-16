<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Periksa apakah role pengguna ada di dalam daftar role yang diizinkan
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak memiliki hak akses, lempar ke halaman yang aman dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki otoritas untuk halaman tersebut.');
    }
}