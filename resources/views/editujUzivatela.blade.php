@extends('layouts.app') 
@section('content')
    <div class="row">
        <div class="col-md-6 card mx-auto">
            <h5 class="text-center">Upraviť používateľa</h5>
            <form action="{{ route('refreshUser', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_name">Meno:</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required pattern="[a-zA-ZáäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ]*" value="{{ $user->first_name }}">
                </div>
    
                <div class="form-group">
                    <label for="last_name">Priezvisko:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required pattern="[a-zA-ZáäčďéěíĺľňóôŕšťúůýžÁÄČĎÉĚÍĹĽŇÓÔŔŠŤÚŮÝŽ]*" value="{{ $user->last_name }}">
                </div>    
    
                <div class="form-group">    
                    <label for="username">Používateľské meno:</label>
                    <input type="text" id="username" name="username" class="form-control" pattern="[a-zA-Z0-9]+" value="{{ $user->username }}">
                </div>
    
                <div class="form-group">
                    <label for="password">Heslo:</label>
                    <input type="password" id="password" name="password" class="form-control" pattern="[a-zA-Z0-9.,_-]*">
                </div>
                
    
                <div class="form-group">
                    <label for="user_type">Typ používateľa:</label>
                    <select id="user_type" name="user_type" required class="form-control">
                        <option value="admin" {{ $user->user_type === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="veduci" {{ $user->user_type === 'veduci' ? 'selected' : '' }}>Veduci</option>
                        <option value="student" {{ $user->user_type === 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary" style="margin-bottom: 20px; margin-top: 20px">Aktualizovať</button>
            </form>
        </div>
    </div>   
@endsection
