<!DOCTYPE html>
<html lang="sk">

@extends('layouts.header')

@section('content')
<div class="card mx-auto" style="width: 50rem;">
    <div class="card-body">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="nazovTemy">Názov témy</span>
            <input type="text" class="form-control" aria-label="Sizing example input">
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="menoVeduceho">Meno vedúceho alebo tútora</span>
            <input type="text" class="form-control" aria-label="Sizing example input">
        </div>

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="obsah">Predmet alebo obsah</span>
            <input type="text" class="form-control" aria-label="Sizing example input">
        </div>

        <div class="card-group">
            <div class="card mx-auto" style="width: 15rem;">
                <div class="card-body">

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="stupen">Stupeň</label>
                        <select class="form-select" id="stupen">
                            <option selected>...</option>
                            <option value="1">Bakalár</option>
                            <option value="2">Inžinier</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="katedra">Katedra</label>
                        <select class="form-select" id="katedra">
                            <option selected>...</option>
                            <option value="1">KIS</option>
                            <option value="2">KI</option>
                            <option value="3">KMME</option>
                            <option value="4">KMNT</option>
                            <option value="5">KMMOA</option>
                            <option value="6">KST</option>
                            <option value="7">KTK</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="card mx-auto" style="width: 15rem;">
                <div class="card-body">

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="stav">Stav práce</label>
                        <select class="form-select" id="stav">
                            <option selected>...</option>
                            <option value="1">nepriradené</option>
                            <option value="2">priradené</option>
                            <option value="3">skončené</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="jazyk">Jazyk práce</label>
                        <select class="form-select" id="jazyk">
                            <option selected>...</option>
                            <option value="1">sk</option>
                            <option value="2">en</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="card mx-auto" style="width: 15rem;">
                <div class="card-body">


                    <div class="input-group mb-3">
                        <label class="input-group-text" for="odbor">Odbor</label>
                        <select class="form-select" id="odbor">
                            <option selected>...</option>
                            <option value="1">MAN</option>
                            <option value="2">INF</option>
                            <option value="3">IaST</option>
                            <option value="4">IaR</option>
                            <option value="5">PI</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="triedenie">Trieď podľa</label>
                        <select class="form-select" id="triedenie">
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
    </div>
</div>

<div class="card mx-auto prace">

</div>
@endsection





</html>