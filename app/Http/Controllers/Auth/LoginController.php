<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // It is allowed to log in and then check email verification status, so we can get custom error messages
            if (! $user->email_verified_at) {
                Auth::logout();

                return back()->withErrors([
                    'email' => __('login.email-unverified'),
                ])->onlyInput('email');
            }

            // Creates a new session ID after login. Prevents session fixation attacks/
            $request->session()->regenerate();

            // DO NOT ALLOW REDIRECT TO CMS
            $intended = $request->session()->get('url.intended');
            if ($intended && str_starts_with($intended, url('/cms'))) {
                return redirect()->route('dashboard');
            }

            // Redirect to the intended page or dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, redirect back with an error message and the email input field (NOT PASSWORD)
        return back()->withErrors([
            'email' => __('login.invalid-credentials'),
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // get localization
        $locale = app()->getLocale();
        Auth::logout();

        // destroy the session, Prevents session hijacking
        $request->session()->invalidate();

        // Protects future requests from CSRF attacks. Keeps forms secure
        $request->session()->regenerateToken();

        return redirect('/')->with('locale', $locale);
    }
}
