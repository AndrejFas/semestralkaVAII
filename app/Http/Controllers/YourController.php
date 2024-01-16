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

    //public function authenticate(Request $request)
    //{
    //    
    //}

    public function pridaj()
    {
        return view('addPracu');
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

    // Ak nie je prihlásený, presmerovať na login
    return redirect()->route('login');
}

}