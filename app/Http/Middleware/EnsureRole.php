<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{

    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // cek autentikasi (belum login)
        if (!$user) {
            return redirect()->route('login');
        }

        // Cek apakah role user ada di daftar role yang diizinkan
        if (!in_array($user->role, $roles, true)) {
            // 403 Forbidden, sudah login tapi tidak punya izin
            abort(403, 'Kamu tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
