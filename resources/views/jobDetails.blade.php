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
                    <!-- The user has applied -->
                    <form id="withdrawForm" method="POST" action="{{ route('withdraw') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Odhlásiť sa</button>
                    </form>
                @else
                    <!-- The user has not applied -->
                    <form id="applyForm" method="POST" action="{{ route('apply') }}">
                        @csrf
                        <input type="hidden" name="tema" value="{{ $job->id }}">
                        <button type="submit" class="btn btn-secondary">Prihlásiť sa na tému</button>
                    </form>
                @endif
            @endif
        @endauth
    </div>


    @auth
        @if((Auth::user()->user_type == 'veduci' && Auth::user()->id == $job->veduci_id )|| Auth::user()->user_type == 'admin')
            @if($job->stav == 'nepriradena')
                <!-- Display the list of applicants -->
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
            <!-- Display the list of assigned students -->
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
    // Add a click event listener to all buttons with class 'priradeniePrace'
    document.querySelectorAll('.priradeniePrace').forEach(function (button) {
        button.addEventListener('click', function () {
            // Get the student ID from the 'data-student-id' attribute
            var studentId = this.getAttribute('data-student-id');
            
            // Call a function to handle the assignment
            assignJobToStudent(studentId);
        });
    });

    // Function to handle the assignment on the client side
    function assignJobToStudent(studentId) {
        // Send an AJAX request to the server to handle the assignment
        // You need to define the appropriate server-side endpoint for job assignment
        // Example using Fetch API:
        fetch('/assign-job', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if applicable
            },
            body: JSON.stringify({
                studentId: studentId,
                jobId: '{{ $job->id }}',
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server
            if (data.success) {
                // Handle the response, e.g., show a success message or update the UI
                console.log(data);
                location.reload(); // Reload the page after successful cancellation
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
    // Add an event listener to handle the cancellation button click
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('zrusPriradenie')) {
            // Get the student ID from the button's data attribute
            var studentId = event.target.getAttribute('data-student-id');

            // Send an AJAX request to the server to cancel the assignment
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
                // Handle the response, e.g., show a success message or update the UI
                console.log(data);
                location.reload(); // Reload the page after successful cancellation
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>   

@endsection

