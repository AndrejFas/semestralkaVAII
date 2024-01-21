@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 card mx-auto">

        <div class="card" style="background-color: white !important; margin-bottom: 15px;">
            <h5>Vložiť text práce</h5>
            
            @if(auth()->user()->file && auth()->user()->file->pdf_text !== null)
                <div>
                    <div style="margin-bottom: 5px"><a href="{{ route('downloadPdfText', auth()->user()->id) }}" class="btn btn-secondary">Stiahnuť PDF Text</a></div>
                    <form id="deletePdfTextForm" method="POST" action="{{ route('deletePdfText', auth()->user()->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Odstrániť PDF Text</button>
                    </form>
                </div>

            @else
                <form id="editPdfTextForm" method="POST" action="{{ route('editPdfText') }}" enctype="multipart/form-data">
                    @csrf
                    <div><label for="pdf_text">Súbor s textom práce nahrávajte prosím vo formáte PDF:</label></div>
                    <input type="file" id="pdf_text" name="pdf_text" accept=".pdf" class="form-control" required>
                    <div style="margin-bottom: 5px; margin-top: 5px"><button type="submit" class="btn btn-secondary">Uložiť PDF Text</button></div>
                </form>
            @endif
        
        </div>   

        <div class="card" style="background-color: white !important; margin-bottom: 15px;">
            <h5>Vložiť prílohy práce</h5>
            
            @if(auth()->user()->file && auth()->user()->file->zip_prilohy !== null)
                <div>
                    <div style="margin-bottom: 5px"><a href="{{ route('downloadZipPrilohy', auth()->user()->id) }}" class="btn btn-secondary">Stiahnuť ZIP Prílohy</a></div>
                    <form id="deleteZipPrilohyForm" method="POST" action="{{ route('deleteZipPrilohy', auth()->user()->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Odstrániť ZIP Prílohy</button>
                    </form>
                </div>
            @else
                <form id="editZipPrilohyForm" method="POST" action="{{ route('editZipPrilohy') }}" enctype="multipart/form-data">
                    @csrf
                    <div><label for="zip_prilohy">Súbor s prílohami k práci nahrávajte prosím vo formáte ZIP:</label></div>
                    <input type="file" id="zip_prilohy" name="zip_prilohy" accept=".zip" class="form-control" required>
                    <div style="margin-bottom: 5px; margin-top: 5px"><button type="submit" class="btn btn-secondary">Uložiť ZIP Prílohy</button></div>
                </form>
            @endif
        
        </div>  

        <div class="card" style="background-color: white !important; margin-bottom: 15px;">
            <h5>Vložiť protokol originality</h5>
            
            @if(auth()->user()->file && auth()->user()->file->pdf_originalita !== null)
                <div>
                    <div style="margin-bottom: 5px"><a href="{{ route('downloadPdfOriginalita', auth()->user()->id) }}" class="btn btn-secondary">Stiahnuť PDF Originalita</a></div>
                    <form id="deletePdfOriginalitaForm" method="POST" action="{{ route('deletePdfOriginalita', auth()->user()->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Odstrániť PDF Originalita</button>
                    </form>
                </div>
            @else
                <form id="editPdfOriginalitaForm" method="POST" action="{{ route('editPdfOriginalita') }}" enctype="multipart/form-data">
                    @csrf
                    <div><label for="pdf_originalita">Súbor s textom práce nahrávajte prosím vo formáte PDF:</label></div>
                    <input type="file" id="pdf_originalita" name="pdf_originalita" accept=".pdf" class="form-control" required>
                    <div style="margin-bottom: 5px; margin-top: 5px"><button type="submit" class="btn btn-secondary">Uložiť PDF Originalita</button></div>
                </form>
            @endif
        
        </div>  

    </div>
</div>

@endsection