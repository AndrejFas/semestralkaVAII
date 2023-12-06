@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">
        <h4 class="center">Pridaj pracu</h4>
        <form action="" method="POST" class="white">
            <div class="form-group">
                <label for="nazovTemy">Názov témy</label>
                <input type="text" name="nazovTemy" class="form-control">
            </div>

            <div class="form-group">
                <label for="veduci">Vedúci</label>
                <input type="text" name="veduci" class="form-control">
            </div>

            <div class="form-group">
                <label for="tutor">Tútor</label>
                <input type="text" name="tutor" class="form-control">
            </div>

            <div class="form-group">
                <label for="popis">Popis</label>
                <textarea rows="5" name="popis" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="popis">Katedra</label>
                <select class="form-select" id="katedra">
                    <option value="KIS">KIS</option>
                    <option value="KI">KI</option>
                    <option value="KMME">KMME</option>
                    <option value="KMNT">KMNT</option>
                    <option value="KMMOA">KMMOA</option>
                    <option value="KST">KST</option>
                    <option value="KTK">KTK</option>
                </select>
            </div>
            

            <div class="form-group">
                <label for="stupen">Stupeň</label>
                <select class="form-select" id="stupen">
                    <option value="Bakalar">Bakalár</option>
                    <option value="Inzinier">Inžinier</option>
                </select>
            </div>

            <div class="form-group">
                <label for="odbor">Odbor</label>
                <select class="form-select" id="odbor">
                    <option value="MAN">MAN</option>
                    <option value="INF">INF</option>
                    <option value="IaST">IaST</option>
                    <option value="IaR">IaR</option>
                    <option value="PI">PI</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jazyk">Jazyk</label>
                <select class="form-select" id="jazyk">
                    <option selected>...</option>
                    <option value="sk">sk</option>
                    <option value="en">en</option>
                </select>
            </div>



            <div>
                <button type="submit" class="btn btn-secondary" style="margin-bottom: 20px; margin-top: 20px" >Pridaj</button>
            </div>

        </form>
    </div>
</div>

@endsection