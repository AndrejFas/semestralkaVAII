<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Applier;

class JobController extends Controller
{
    public function addJob(Request $request)
    {
        $request->validate([
            'nazov' => 'required|max:50',
            'veduci' => 'required|regex:/^[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ ]+$/|max:20',
            'veduci_id' => 'required',
            'tutor' => 'nullable|regex:/^[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ ]+$/|max:20',
            'popis' => 'required',
            'stupen' => 'required|string',
            'odbor' => 'required|string',
            'katedra' => 'required|string',
        ]);

        $job = Job::create([
            'nazov' => $request->input('nazov'),
            'veduci' => $request->input('veduci'),
            'veduci_id' => $request->input('veduci_id'),
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

        return redirect()->route('prace')->with('success', 'Práca odstánená.');
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
            'veduci_id' => $request->input('veduci_id'),
            'tutor' => $request->input('tutor'),
            'popis' => $request->input('popis'),
            'stupen' => $request->input('stupen'),
            'jazyk' => $request->input('jazyk'),
            'odbor' => $request->input('odbor'),
            'katedra' => $request->input('katedra'),
            'stav' => $request->input('stav'),
            'student' => $request->input('student'),
            'cas' => now(),
        ]);
        return redirect()->route('jobDetails', $job->id)->with('success', 'Užívateľ bol aktualizovaný.');
    }

    public function showJobView(Request $request){
        $jobs = Job::paginate(5); 
        return view('prace', ['jobs' => $jobs]);
    }

    public function filterJobs(Request $request)
    {
        $query = Job::query();

        // nazov
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
        $job = Job::findOrFail($id); 
        return view('jobDetails', ['job' => $job]);
    }

    public function apply(Request $request)
    {
        $studentId = auth()->user()->id;
        Applier::create([
            'tema' => $request->input('tema'),
            'student' => $studentId,
        ]);

        return back();
    }


    public function withdraw(Request $request)
    {
        $studentId = auth()->user()->id;
        $tema = $request->input('tema');
        Applier::where('tema', $tema)->where('student', $studentId)->delete();
        return back();
    }
    
    public function assignJob(Request $request)
    {
        $request->validate([
            'studentId' => 'required|exists:users,id', 
            'jobId' => 'required|exists:jobs,id', 
        ]);

        $job = Job::find($request->input('jobId'));
        $job->student = $request->input('studentId');
        $job->stav = "priradena";
        $job->save();

        return response()->json(['success' => true]);
    }

    public function cancelAssignment(Request $request)
    {
        $job = Job::find($request->input('jobId'));
        $job->student = null;
        $job->stav = "nepriradene";
        $job->save();

        return response()->json(['success' => true]);
    }

    public function showAddPracuView(Request $request){return view('addPracu');}
    
}