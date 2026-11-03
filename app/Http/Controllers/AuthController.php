<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

/**
 * Handles administrator authentication: login and logout.
 */
class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * Already authenticated admins are redirected to the dashboard.
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt (with rate limiting).
     */
    public function login(Request $request)
    {
        // Validate the input with custom error messages.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Throttle key combines the email and IP address; max 5 attempts.
        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan masuk. Silakan tunggu {$seconds} detik lagi.",
            ]);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Only active administrators are allowed to sign in.
            if ($user->role !== 'admin' || $user->status !== 'Aktif') {
                Auth::logout();
                RateLimiter::hit($throttleKey);
                return back()->withErrors([
                    'email' => 'Akses ditolak. Akun ini bukan administrator aktif.',
                ]);
            }

            // Success: reset the limiter and regenerate the session
            // to protect against session fixation.
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // Failed attempt: record it against the rate limiter.
        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => 'Email atau kata sandi tidak sesuai dengan data kami.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sesi admin.');
    }
}
