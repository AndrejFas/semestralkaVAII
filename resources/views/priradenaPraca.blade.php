@extends('layouts.app')

@section('content')
    <div class="col-md-6 card mx-auto">
        

        

            <!-- Check if the job is assigned to the current user -->
            @php
                $assignedJob = \App\Models\Job::where('student', Auth::user()->id)->first();
            @endphp

            @if($assignedJob)
                <!-- Display information about the assigned job -->
                <div class="assigned-job-info">
                    <h2>Priradená práca:</h2>
                    <h1>{{ $assignedJob->odbor }} - {{ $assignedJob->nazov }}</h1>
                    <p>Vedúci: {{ $assignedJob->veduci }}</p>
                    <p>Tutor: {{ $assignedJob->tutor }}</p>
                    <p>{{ $assignedJob->popis }}</p>
                    <p>Stav: {{ $assignedJob->stav }}</p>
                    <p>Katedra: {{ $assignedJob->katedra }}</p>
                    <p>Stupeň: {{ $assignedJob->stupen }}</p>
                    <p>Jazyk: {{ $assignedJob->jazyk }}</p>
                </div>
            @else
                <p>Žiadna práca nebola priradená</p>
            @endif   
    </div>
@endsection