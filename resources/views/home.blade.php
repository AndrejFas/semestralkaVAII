@extends('layouts.app')
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
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf
        
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        
            @error('login')
                <div>{{ $message }}</div>
            @enderror
        
            <button type="submit">Login</button>
        </form>
    </div>
</div>



@endsection