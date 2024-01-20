<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    public function addJob(Request $request)
    {
        $request->validate([
            'nazov' => 'required|string',
            'veduci' => 'required|string',
            'popis' => 'required',
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
            'popis' => 'required',
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

    public function showJobView(Request $request){
        $jobs = Job::all(); // Assuming 'File' is your Eloquent model for the 'files' table
        return view('prace',['jobs' => $jobs]);
    }

    public function filterFilter(Request $request)
    {
        Log::info('Received request:', $request->all());

        $query = Job::query();

        // Nazov
        if ($request->filled('nazov')) {
            $query->where('nazov', 'LIKE', '%' . $request->input('nazov') . '%');
        }
        // veduci
        if ($request->filled('meno')) {
            $query->where(function ($query) use ($request) {
                $query->where('veduci', 'LIKE', '%' . $request->input('meno') . '%')
                      ->orWhere('tutor', 'LIKE', '%' . $request->input('meno') . '%');
            });
        }
        // obsah
        if ($request->filled('obsah')) {
            $query->where('popis', 'LIKE', '%' . $request->input('obsah') . '%');
        }
        // stupen
        if ($request->filled('stupen')) {
            $query->where('stupen', $request->input('stupen'));
        }
        // stav
        if ($request->filled('stav')) {
            $query->where('stav', $request->input('stav'));
        }
        // odbor
        if ($request->filled('odbor')) {
            $query->where('odbor', $request->input('odbor'));
        }
        // katedra
        if ($request->filled('katedra')) {
            $query->where('katedra', $request->input('katedra'));
        }
        // jazyk
        if ($request->filled('jazyk')) {
            $query->where('jazyk', $request->input('jazyk'));
        }

        $filteredJobs = $query->get();

        return response()->json(['jobs' => $filteredJobs]);
    }

    public function jobDetails($id)
    {
        $job = Job::findOrFail($id); // Adjust the model and method based on your project
        return view('jobDetails', ['job' => $job]);
    }

}