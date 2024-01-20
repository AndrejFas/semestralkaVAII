@extends('layouts.app')

@section('content')
    <div class="col-md-6 card mx-auto">
        <h1>{{ $job->odbor }} - {{ $job->nazov }}</h1>
        <p>Vedúci: {{ $job->veduci }}</p>
        <p>Tutor: {{ $job->tutor }}</p>
        <p>{{ $job->popis }}</p>
        <p>Stav: {{ $job->stav }}</p>
        <p>Katedra: {{ $job->katedra }}</p>
        <p>Stupeň: {{ $job->stupen }}</p>
        <p>Jazyk: {{ $job->jazyk }}</p>

        @auth
            @if(Auth::user()->user_type == 'student')

                @if(\App\Models\Applier::where('tema', $job->id)->where('student', Auth::user()->id)->exists())
                    <!-- The user has applied -->
                    <form id="withdrawForm" method="POST" action="{{ route('withdraw') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Odhlásiť sa</button>
                    </form>
                @else
                    <!-- The user has not applied -->
                    <form id="applyForm" method="POST" action="{{ route('apply') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Prihlásiť sa na tému</button>
                    </form>
                @endif
            @endif
        @endauth
    </div>
@endsection