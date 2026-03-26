<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function show(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => null,
        ]);

        // for purpose of exam, we will not send email verification, we will mark email as verified
        $user->markEmailAsVerified();
        // we won't login automatically, so we will do it manually, since we are pretending that user will validate

        return redirect(route('login'))->with('status', __('login.registration-success'));
    }
}
