<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->is_active) {
            return redirect()->route('verification.notice')
                ->with('error', 'Akun Anda belum aktif. Silakan verifikasi email Anda.');
        }

        return $next($request);
    }
} 