@extends('layouts.app') 

@section('content')
    


    <div class="row">
        <div class="col-md-6 card mx-auto">
            <h5 class="text-center">Používatelia</h5>


            @if(count($users) > 0)
                
                    @foreach($users as $user)
                
                    <div class="card" style="background-color: white !important">
                        {{ $user->first_name }} {{ $user->last_name }} {{$user->username}} {{$user->user_type}}
                        <form action="{{ route('odstranUzivatele', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary">Odstraniť</button>
                            <a href="{{ route('editujUzivatela', $user->id) }}" class="btn btn-secondary">Upraviť</a>
                        </form>
                        
                    </div>                            
                
                    @endforeach
                
            @else
                <p>Žádní uživatelé nebyli nalezeni.</p>
            @endif
    
            
        </div>
    </div>


    
@endsection