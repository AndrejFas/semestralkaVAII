@extends('layouts.app')

@section('content')
    <div class="col-md-6 card mx-auto">
        <h1>{{ $job->odbor }} - {{ $job->nazov }}</h1>
        <p>Vedúci: {{ $job->veduci }}</p>
        <p>Tutor: {{ $job->tutor }}</p>
        <p>{{ $job->popis }}</p>
        <p>Stav: {{ $job->stav }}</p>
        <p>Katedra: {{ $job->katedra }}</p>
        <p>Stupeň: {{ $job->stupen }}</p>
        <p>Jazyk: {{ $job->jazyk }}</p>

        @auth
            @if(Auth::user()->user_type == 'student')

                @if(\App\Models\Applier::where('tema', $job->id)->where('student', Auth::user()->id)->exists())
                    <form id="withdrawForm" method="POST" action="{{ route('withdraw') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Odhlásiť sa</button>
                    </form>
                @else
                    <form id="applyForm" method="POST" action="{{ route('apply') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Prihlásiť sa na tému</button>
                    </form>
                @endif
            @endif
        @endauth

        @auth
            @if(Auth::user()->user_type == 'veduci' && Auth::user()->id == $job->veduci_id )
                <form action="{{ route('deleteJob', $job->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary">Odstrániť</button>
                    <a href="{{ route('editJob', $job->id) }}" class="btn btn-secondary">Upraviť</a>
                </form>
            @endif
        @endauth

        @auth
            @if(Auth::user()->user_type == 'admin')
                <form action="{{ route('deleteJobAdmin', $job->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary">Odstrániť</button>
                    <a href="{{ route('editJobAdmin', $job->id) }}" class="btn btn-secondary">Upraviť</a>
                </form>
            @endif
        @endauth
    </div>


    @auth
        @if((Auth::user()->user_type == 'veduci' && Auth::user()->id == $job->veduci_id )|| Auth::user()->user_type == 'admin')
            @if($job->stav == 'nepriradene')
                <div class="col-md-6 card mx-auto">
                    <h4>Prihlásení študenti:</h4>
                    <ul>
                        @foreach(\App\Models\Applier::where('tema', $job->id)->get() as $applier)
                            <li>
                                {{ $applier->user->first_name }} {{ $applier->user->last_name }} {{ $applier->user->username }}
                                <div><button type="button" class="btn btn-secondary priradeniePrace" data-student-id="{{ $applier->user->id }}">Priradiť</button></div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($job->stav == 'priradena')
            <div class="col-md-6 card mx-auto">
                <h4>Priradený študent</h4>
                <ul>
                    @php
                        $student = \App\Models\User::find($job->student);
                    @endphp
                    <li>
                        {{ $student->first_name }} {{ $student->last_name }} {{ $student->username }}
                        <button type="button" class="btn btn-secondary zrusPriradenie" data-student-id="{{ $student->id }}">Zruš</button>
                    </li>
                </ul>
            </div>
        @endif
    @endif
@endauth

<script>
    document.addEventListener('DOMContentLoaded', function () {
    
    document.querySelectorAll('.priradeniePrace').forEach(function (button) {
        button.addEventListener('click', function () {

            var studentId = this.getAttribute('data-student-id'); //id studenta

            assignJobToStudent(studentId);
        });
    });

    function assignJobToStudent(studentId) {
        fetch('/assign-job', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                studentId: studentId,
                jobId: '{{ $job->id }}',
            }),
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {
                console.log(data);
                location.reload(); 
            } else {
                alert('Chyba pri priradení práce.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    });
</script>

<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('zrusPriradenie')) {
            
            var studentId = event.target.getAttribute('data-student-id');

            fetch('{{ route("cancelAssignment") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ studentId: studentId, jobId: {{ $job->id }} })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>

@endsection

