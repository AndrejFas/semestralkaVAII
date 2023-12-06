@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">

        <form action="">

            <div class="form-group">
                <label for="nazovTemy">Názov témy</label>
                <input type="text" name="nazovTemy" class="form-control">

            </div>
    
            <div class="form-group">
                <label for="menoVeduceho">Meno vedúceho alebo tútora</label>
                <input type="text" name="menoVeduceho" class="form-control">
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
                            <select class="form-select" id="stupen">
                                <option selected>...</option>
                                <option value="1">Bakalár</option>
                                <option value="2">Inžinier</option>
                            </select>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="katedra">Katedra</label>
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
    
                <div class="card mx-auto" >
                    <div class="card-body">
    
                        <div class="form-group mb-3">
                            <label for="stav">Stav práce</label>
                            <select class="form-select" id="stav">
                                <option selected>...</option>
                                <option value="1">nepriradené</option>
                                <option value="2">priradené</option>
                                <option value="3">skončené</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jazyk">Jazyk práce</label>
                            <select class="form-select" id="jazyk">
                                <option selected>...</option>
                                <option value="1">sk</option>
                                <option value="2">en</option>
                            </select>
                        </div>
    
                    </div>
                </div>
    
                <div class="card mx-auto" >
                    <div class="card-body">
    
    
                        <div class="form-group mb-3">
                            <label for="odbor">Odbor</label>
                            <select class="form-select" id="odbor">
                                <option selected>...</option>
                                <option value="1">MAN</option>
                                <option value="2">INF</option>
                                <option value="3">IaST</option>
                                <option value="4">IaR</option>
                                <option value="5">PI</option>
                            </select>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="triedenie">Trieď podľa</label>
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

        </form>

        
    </div>
</div>

@endsection