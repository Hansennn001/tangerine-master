<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Validation\Rules;
use ReCaptcha\ReCaptcha;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => 'required|date',
            'g-recaptcha-response' => 'required',
        ]);

        if (!app()->environment('local')) {
            $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

            if (!$response->isSuccess()) {
                return back()->withErrors(['captcha' => 'Captcha verification failed']);
            }
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
        ]);
        session()->flash('success', 'Registration successful, please login.');
        
        return redirect()->route('login')->with('success', 'Registration successful, please login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        if (!app()->environment('local')) {
            $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

            if (!$response->isSuccess()) {
                return back()->withErrors(['captcha' => 'Captcha verification failed']);
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid login credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        Password::sendResetLink($request->only('email'));
        return back()->with('status', 'Password reset link sent to your email.');
    }
}
