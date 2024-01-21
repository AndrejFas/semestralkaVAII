<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::notIn(['http', 'https']) 
            ],
            'password' => [
                'required',
                'regex:/^[a-zA-Z0-9.,_-]+$/',
                Rule::notIn(['http', 'https']) 
            ],
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('login');
        }

        return redirect()->back()->withErrors(['login' => 'Nesprávne prihlasovacie údaje.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}