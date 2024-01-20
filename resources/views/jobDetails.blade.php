
@extends('layouts.app')

@section('content')
    <div class="col-md-6 card mx-auto">
        <h1>{{ $job->odbor }} - {{ $job->nazov }}</h1>
        <p>Vedúci: {{ $job->veduci }}</p>
        <p>Tutor: {{ $job->tutor }}</p>
        <p>{{$job->popis}}</p>
        <p>Stav: {{ $job->stav }}</p>
        <p>Katedra: {{ $job->katedra }}</p>
        <p>Stupeň: {{ $job->stupen }}</p>
        <p>Jazyk: {{ $job->jazyk }}</p>

    </div>
@endsection