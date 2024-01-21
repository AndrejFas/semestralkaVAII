<?php

namespace App\Http\Controllers;

use App\Models\Applier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Job;

class PouzivatelController extends Controller
{
    public function addUser(Request $request)
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
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        // Ak je typ používateľa "student", vytvorí nový záznam v tabuľke "files"
        if ($user->user_type === 'student') {
            $file = File::create([
                'student_id' => $user->id,
                'pdf_text' => null,
                'zip_prilohy' => null,
                'pdf_originalita' => null,
            ]);
        }

        // prípadne môžete pridať ďalšie úpravy alebo presmerovanie
        return redirect()->route('showUser')->with('success', 'Používateľ bol úspešne pridaný.');
    }


    public function showUser()
    {
        $users = User::all();
        return view('zobrazUzivatele', compact('users'));
    }

    public function deleteUser($id)
    {

        File::where('student_id', $id)->delete();

        $user = User::findOrFail($id);
        $user->delete();

        Applier::where('student', $id)->delete();

        Job::where('student', $id)->update([
            'student' => null,
            'stav' => 'nepriradene',
        ]);

        return redirect()->route('showUser')->with('success', 'Uživatel byl odstraněn.');
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('editujUzivatele', compact('user'));
    }

    public function refreshUser(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'nullable|string|unique:users',
            'password' => 'nullable|string',
            'user_type' => 'required|in:admin,veduci,student',
        ]);

        $user = User::findOrFail($id);

        // Aktualizácia hodnôt
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            //'username' => $request->input('username'),
            'user_type' => $request->input('user_type'),
        ]);

        // Ak bol zadaný nový password, aktualizuj ho
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->input('password')),
            ]);
        }

        if ($request->filled('username')) {
            $user->update([
                'username' => $request->input('username'),
            ]);
        }

        if ($user->user_type === 'student') {
            // Check if a record with the specified student_id already exists
            $existingFile = File::where('student_id', $user->id)->first();
        
            if (!$existingFile) {
                // If no record exists, create a new one
                $file = File::firstOrCreate(
                    ['student_id' => $user->id],
                    [
                        'pdf_text' => null,
                        'zip_prilohy' => null,
                        'pdf_originalita' => null,
                    ]
                );
            }
        }

        return redirect()->route('showUser')->with('success', 'Užívateľ bol aktualizovaný.');
    }

}
