<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function addJob(Request $request)
    {
        $request->validate([
            'nazov' => 'required|string',
            'veduci' => 'required|string',
            'popis' => 'required|string',
            'stupen' => 'required|string',
            'odbor' => 'required|string',
            'katedra' => 'required|string',
        ]);

        $job = Job::create([
            'nazov' => $request->input('nazov'),
            'veduci' => $request->input('veduci'),
            'tutor' => $request->input('tutor'),
            'student' => null,
            'popis' => $request->input('popis'),
            'stav' => 'nepriradene',
            'stupen' => $request->input('stupen'),
            'jazyk' => $request->input('jazyk'),
            'odbor' => $request->input('odbor'),
            'katedra' => $request->input('katedra'),
            'cas' => now(),
        ]);

        if ($job->wasRecentlyCreated) {
            return redirect()->route('addJobView')->with('success', 'Práca bola úspešne pridaná.');
        } else {
            return redirect()->route('addJobView')->with('error', 'Nepodarilo sa vytvoriť pracu.');
        }
    }

    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('addJob')->with('success', 'Práca odstánená.');
    }

    public function editJob($id)
    {
        $job = Job::findOrFail($id);
        return view('editujPracu', compact('job'));
    }

    public function refreshJob(Request $request, $id)
    {
        $request->validate([
            'nazov' => 'required|string',
            'veduci' => 'required|string',
            'popis' => 'required|string',
            'stupen' => 'required|string',
            'odbor' => 'required|string',
            'katedra' => 'required|string',
        ]);

        $job = Job::findOrFail($id);

        $job->update([
            'nazov' => $request->input('nazov'),
            'veduci' => $request->input('veduci'),
            'tutor' => $request->input('tutor'),
            'popis' => $request->input('popis'),
            'stupen' => $request->input('stupen'),
            'jazyk' => $request->input('jazyk'),
            'odbor' => $request->input('odbor'),
            'katedra' => $request->input('katedra'),
            'cas' => now(),
        ]);
        return redirect()->route('showUser')->with('success', 'Užívateľ bol aktualizovaný.');
    }

}