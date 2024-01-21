@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">
        <h5 class="card-title">Súbory študentov</h5>

        <ul>
            @foreach ($files as $file)
                <li>{{ $file->user->first_name }} {{ $file->user->last_name }} </li>

                <div class="card-group" style="margin-top: 10px">
                    <div class="card mx-auto">
                        <div class="card-body">
    
                            <div class="form-group mb-3">

                                @if($file->pdf_text != null)
                                    <div style="margin-bottom: 5px"><a href="{{ route('downloadPdfTextAdmin', $file->user->id) }}" class="btn btn-secondary">Stiahnuť PDF Text</a></div>
                                    <form id="deletePdfTextForm" method="POST" action="{{ route('deletePdfTextAdmin', $file->user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Odstrániť PDF Text</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mx-auto">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                @if($file->zip_prilohy != null)
                                    <div style="margin-bottom: 5px"><a href="{{ route('downloadZipPrilohyAdmin', $file->user->id) }}" class="btn btn-secondary">Stiahnuť ZIP Prílohy</a></div>
                                    <form id="deleteZipPrilohyForm" method="POST" action="{{ route('deleteZipPrilohyAdmin', $file->user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Odstrániť ZIP Prílohy</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mx-auto">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                @if($file->pdf_originalita != null)  
                                    <div style="margin-bottom: 5px"><a href="{{ route('downloadPdfOriginalitaAdmin', $file->user->id) }}" class="btn btn-secondary">Stiahnuť PDF Originalita</a></div>
                                    <form id="deletePdfOriginalitaForm" method="POST" action="{{ route('deletePdfOriginalitaAdmin', $file->user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Odstrániť PDF Originalita</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
</div>
@endsection