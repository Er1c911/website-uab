<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('is_admin_authenticated', false)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $configuredUsername = (string) config('auth.admin.username');
        $configuredPassword = (string) config('auth.admin.password');

        $isUsernameValid = hash_equals($configuredUsername, $validated['username']);
        $isPasswordValid = hash_equals($configuredPassword, $validated['password']);

        if (! $isUsernameValid || ! $isPasswordValid) {
            return back()
                ->withErrors(['login' => 'Username atau password admin tidak valid.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->session()->put('is_admin_authenticated', true);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('is_admin_authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}