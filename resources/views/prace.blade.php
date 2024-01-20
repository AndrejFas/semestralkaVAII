@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">

        <form id="filterForm">

            <div class="form-group">
                <label for="nazov">Názov témy</label>
                <input type="text" name="nazov" class="form-control">

            </div>

            <div class="form-group">
                <label for="meno">Meno vedúceho alebo tútora</label>
                <input type="text" name="meno" class="form-control">
            </div>

            <div class="form-group">
                <label for="obsah">Predmet alebo obsah</label>
                <input type="text" name="obsah" class="form-control">
            </div>

            <div class="card-group" style="margin-top: 10px">
                <div class="card mx-auto">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="stupen">Stupeň</label>
                            <select class="form-select" name="stupen">
                                <option selected></option>
                                <option value="Bakalar">Bakalár</option>
                                <option value="Inzinier">Inžinier</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="katedra">Katedra</label>
                            <select class="form-select" name="katedra">
                                <option selected></option>
                                <option value="KIS">KIS</option>
                                <option value="KI">KI</option>
                                <option value="KMME">KMME</option>
                                <option value="KMNT">KMNT</option>
                                <option value="KMMOA">KMMOA</option>
                                <option value="KST">KST</option>
                                <option value="KTK">KTK</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card mx-auto" >
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="stav">Stav práce</label>
                            <select class="form-select" name="stav">
                                <option selected></option>
                                <option value="nepriradene">nepriradené</option>
                                <option value="priradene">priradené</option>
                                <option value="skoncene">skončené</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jazyk">Jazyk práce</label>
                            <select class="form-select" name="jazyk">
                                <option selected></option>
                                <option value="sk">sk</option>
                                <option value="en">en</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card mx-auto" >
                    <div class="card-body">


                        <div class="form-group mb-3">
                            <label for="odbor">Odbor</label>
                            <select class="form-select" name="odbor">
                                <option selected></option>
                                <option value="MAN">MAN</option>
                                <option value="INF">INF</option>
                                <option value="IaST">IaST</option>
                                <option value="IaR">IaR</option>
                                <option value="PI">PI</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="triedenie">Trieď podľa</label>
                            <select class="form-select" name="triedenie">
                                <option value="1">Času</option>
                                <option value="2">Názvu</option>
                                <option value="3">Vedúci</option>
                                <option value="4">Stupeň</option>
                                <option value="5">Katedra</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="filterButton">Filter</button>
        </form>
    </div>
</div>




@if(count($jobs) > 0)

    @foreach($jobs as $job)
        <div class="row jobResults">
            <div class="col-md-6 card mx-auto">
                <a href="">{{$job->odbor}} - {{$job->nazov}}</a>
                <p>Vedúci: {{$job->veduci}}</p>
                <p>{!! nl2br(e(Str::limit($job->popis, 300))) !!}</p> {{-- Adjust the character limit as needed --}}
                <p>Stav: {{$job->stav}} </p>
            </div>
        </div>
    @endforeach

@else
    <p>Neboli nájdene žiadne</p>
@endif


<script src="{{ asset('js/filterScript.js') }}"></script>


@endsection


{{-- <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Odstrániť</button>
                <a href="{{ route('editUser', $user->id) }}" class="btn btn-secondary">Upraviť</a>
            </form> --}}