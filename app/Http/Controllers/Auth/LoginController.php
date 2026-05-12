<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nis_or_nip' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'admin' => redirect()->intended(route('admin.dashboard')),
                'guru' => redirect()->intended(route('guru.dashboard')),
                'santri' => redirect()->intended(route('santri.dashboard')),
                default => redirect()->intended(route('home')),
            };
        }

        return back()->withErrors([
            'nis_or_nip' => 'NIS/NIP atau password salah.',
        ])->onlyInput('nis_or_nip');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
