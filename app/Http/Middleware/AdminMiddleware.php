<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login terlebih dahulu untuk mengakses dashboard.']);
        }

        if (Auth::user()->role !== 'admin' || Auth::user()->status !== 'Aktif') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors(['email' => 'Akses ditolak. Halaman ini hanya diperuntukkan bagi Administrator aktif.']);
        }

        return $next($request);
    }
}
