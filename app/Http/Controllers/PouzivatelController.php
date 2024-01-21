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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'user_type' => 'required|in:admin,veduci,student',
        ]);

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        if ($user->user_type === 'student') {
            $file = File::create([
                'student_id' => $user->id,
                'pdf_text' => null,
                'zip_prilohy' => null,
                'pdf_originalita' => null,
            ]);
        }

        return redirect()->route('showUser')->with('success', 'Používateľ bol úspešne pridaný.');
    }

    public function showUser()
    {
        $users = User::all();
        return view('zobrazUzivatela', compact('users'));
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

        return redirect()->route('showUser')->with('success', 'Používateľ bol odstránený.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('editujUzivatela', compact('user'));
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

        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_type' => $request->input('user_type'),
        ]);

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
            $existingFile = File::where('student_id', $user->id)->first();
        
            if (!$existingFile) {
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
