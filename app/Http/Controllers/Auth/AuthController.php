<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'role' => ['required', 'in:admin,siswa'],
            'password' => ['required'],
            'email' => ['nullable', 'email'], // hanya dipakai admin
            'nis' => ['nullable'], // hanya dipakai siswa
        ]);

        // Tentukan field berdasarkan role
        $loginField = $credentials['role'] === 'admin' ? 'email' : 'nis';
        $loginValue = $credentials['role'] === 'admin' ? $credentials['email'] : $credentials['nis'];

        if (Auth::attempt([
            $loginField => $loginValue,
            'password' => $credentials['password'],
            'role' => $credentials['role'],
        ], $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(Auth::user()->role === 'admin' ? '/dashboard' : '/siswa/beranda');
        }

        throw ValidationException::withMessages([
            $loginField => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
