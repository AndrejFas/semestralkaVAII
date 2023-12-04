
@extends('layouts.header')
@section('content')

<div class="row">
    <div class="col-md-6 card mx-auto">
        <h5 class="card-title">Linky</h5>

        <div>
            <a href="https://nic.uniza.sk/nms/main/index/main" >LDAP uniza</a>
            <p style="margin: 0;display: inline; float: right;" >Vytvorte/zmeňte si LDAP heslo na prihlásenie do systému EZP.</p>
        </div>

        <div>
            <a href="https://kniznica.uniza.sk/ezp?fs=4D0CE7678C4F4DCB82C35F84EAEB4484&fn=main" >Evidencia záverečných prác</a>
            <p style="margin: 0;display: inline; float: right;" >Tu odovzdajte vypracovanú prácu na overenie originality.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 card mx-auto">
        <h5 class="text-center">Pre prístup k záverečným prácam je potrebné prihlásenie</h5>
        <form action="{{ route('login') }}" method="post" >
            <div class="form-group">
                <label for="meno">Prihlasovacie meno</label>
                <input required type="text" value="{{ old('login') }}" class="form-control" placeholder="login" name = "login" id="login">
                {{-- <p class="small text-danger">{{}}</p> --}}
            </div>
    
            <div class="form-group">
                <label  for="heslo">Heslo</label>
                <input required type="text" value="{{ old('heslo') }}" class="form-control" placeholder="heslo" name="heslo" id="heslo">
                {{-- <p class="small text-danger">{{}}</p> --}}
            </div>
    
            <button type="submit" class="btn btn-secondary" style="margin-bottom: 20px; margin-top: 20px" >Prihlásiť sa</button>
        </form>
    </div>
</div>



@endsection
    
