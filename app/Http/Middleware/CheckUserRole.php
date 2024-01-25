<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Pastikan peran pengguna terdapat dalam daftar peran yang diizinkan
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect atau kembalikan sesuai kebutuhan Anda
        return redirect('/home')->with('error', 'Unauthorized access.');
    }
}
