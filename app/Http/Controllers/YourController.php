<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class YourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showLoginForm');
    }

    public function showLoginForm()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {
        // Vaša autentifikačná logika
    }

    public function pridaj()
    {
        return view('add');
    }


    public function showDashboard()
{
    $user = Auth::user();

    if ($user) {
        // Rozlíšenie podľa user_type
        switch ($user->user_type) {
            case 'admin':
                return view('admin.dashboard');
                break;
            case 'veduci':
                return view('veduci.dashboard');
                break;
            case 'student':
                return view('student.dashboard');
                break;
        }
    }

    // Ak nie je prihlásený, môžete presmerovať na login alebo vykonať inú akciu
    return redirect()->route('login');
}

public function addNewUser(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'user_type' => 'required|in:admin,user',
        ]);

        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        return 'Nový používateľ bol pridaný do databázy.';
    }

    
    public function addUser(){
        return view('addPouzivatel');
    }

}