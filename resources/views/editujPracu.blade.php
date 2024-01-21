@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">
        <h4 class="center">Edituj pracu</h4>
            @if(Auth::user()->user_type == 'veduci')
                <form action="{{ route('refreshJob', $job->id) }}" method="POST" class="white">
            @endif
            
            @if(Auth::user()->user_type == 'admin')
                <form action="{{ route('refreshJobAdmin', $job->id) }}" method="POST" class="white">
            @endif
        
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nazovTemy">Názov témy</label>
                <input type="text" id="nazov" name="nazov" class="form-control" required maxlength="50" value="{{ $job->nazov }}">
            </div>
        
            <div class="form-group">
                <label for="veduci">Vedúci</label>
                <input type="text" name="veduci" class="form-control" required pattern="[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ ]+" maxlength="20" value="{{ $job->veduci }}">
            </div>
        
            <div class="form-group">
                <label for="tutor">Tútor</label>
                <input type="text" name="tutor" class="form-control" pattern="[A-Za-záäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ ]+" maxlength="20" value="{{ $job->tutor }}">
            </div>
        
            <div class="form-group">
                <label for="popis">Popis</label>
                <textarea rows="5" name="popis" class="form-control" required>{{ $job->popis }}</textarea>
            </div>

            <div class="form-group">
                <label for="katedra">Katedra</label>
                <select class="form-select" name="katedra">
                    <option value="KIS" {{ $job->katedra === 'KIS' ? 'selected' : '' }}>KIS</option>
                    <option value="KI" {{ $job->katedra === 'KI' ? 'selected' : '' }}>KI</option>
                    <option value="KMME" {{ $job->katedra === 'KMME' ? 'selected' : '' }}>KMME</option>
                    <option value="KMNT" {{ $job->katedra === 'KMNT' ? 'selected' : '' }}>KMNT</option>
                    <option value="KMMOA" {{ $job->katedra === 'KMMOA' ? 'selected' : '' }}>KMMOA</option>
                    <option value="KST" {{ $job->katedra === 'KST' ? 'selected' : '' }}>KST</option>
                    <option value="KTK" {{ $job->katedra === 'KTK' ? 'selected' : '' }}>KTK</option>
                </select>
            </div>
            

            <div class="form-group">
                <label for="stupen">Stupeň</label>
                <select class="form-select" name="stupen">
                    <option value="Bakalar" {{ $job->stupen === 'Bakalar' ? 'selected' : '' }}>Bakalár</option>
                    <option value="Inzinier" {{ $job->stupen === 'Inzinier' ? 'selected' : '' }}>Inžinier</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="odbor">Odbor</label>
                <select class="form-select" name="odbor">
                    <option value="MAN" {{ $job->odbor === 'MAN' ? 'selected' : '' }}>MAN</option>
                    <option value="INF" {{ $job->odbor === 'INF' ? 'selected' : '' }}>INF</option>
                    <option value="IaST" {{ $job->odbor === 'IaST' ? 'selected' : '' }}>IaST</option>
                    <option value="IaR" {{ $job->odbor === 'IaR' ? 'selected' : '' }}>IaR</option>
                    <option value="PI" {{ $job->odbor === 'PI' ? 'selected' : '' }}>PI</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="jazyk">Jazyk</label>
                <select class="form-select" name="jazyk">
                    <option value="sk" {{ $job->jazyk === 'sk' ? 'selected' : '' }}>sk</option>
                    <option value="en" {{ $job->jazyk === 'en' ? 'selected' : '' }}>en</option>
                </select>
            </div>

            <input type="hidden" name="veduci_id" value= {{$job->veduci_id}}>
            <input type="hidden" name="stav" value= {{$job->stav}}>
            <input type="hidden" name="student" value= {{$job->student}}>

            <div>
                <button type="submit" id="pridajPracuBtn" class="btn btn-secondary" style="margin-bottom: 20px; margin-top: 20px" >Uprav</button>
            </div>

        </form>
    </div>
</div>

@endsection