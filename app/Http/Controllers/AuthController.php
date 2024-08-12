<?php

namespace App\Http\Controllers;

use App\Events\UserRegister;
use App\Listeners\SendEmailForRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
       $validate =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);
       $validate['password'] = Hash::make($validate['password']);
        $user = User::create($validate);
        auth()->login($user);
        event( new UserRegister($user));
        if($request->register)
        {
            event(new SendEmailForRegister($user));
        }

        return redirect()->intended('/')->with('success', 'Your account has been created.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('auth.login');
    }
}
