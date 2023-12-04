
@extends('layouts.header')
@section('content')
<div class="card mx-auto" style="width: 50rem;">
    <div class="card-body">
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

<div class="card mx-auto" style="width: 50rem;">
    <div class="card-body">
        <h5 class="card-title">Pre prístup k záverečným prácam je potrebné prihlásenie</h5>

        <form action="" method="POST" >
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="meno">Prihlasovacie meno</span>
                <input type="text" class="form-control" aria-label="Sizing example input">
            </div>
    
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="heslo">Heslo</span>
                <input type="text" class="form-control" aria-label="Sizing example input">
            </div>
    
            <button>Prihlásiť sa</button>
        </form>
        

    </div>
</div>
@endsection
    
