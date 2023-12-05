<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // prípadne prispôsobte podľa vášho modelu

class PouzivatelController extends Controller
{
    public function pridajPouzivatela(Request $request)
    {

        // validácia dát
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'user_type' => 'required|in:admin,veduci,student',
        ]);

        // vytvorenie nového používateľa v databáze
        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        // prípadne môžete pridať ďalšie úpravy alebo presmerovanie
        return redirect()->back()->with('success', 'Používateľ bol úspešne pridaný.');
    }


    public function zobrazUzivatele()
    {
        $users = User::all();
        return view('zobrazUzivatele', compact('users'));
    }

    public function odstranUzivatele($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('zobrazUzivatele')->with('success', 'Uživatel byl odstraněn.');
    }
}
