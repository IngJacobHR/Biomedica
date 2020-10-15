@extends('layouts.app')

@section('content')

<h1 class="display-8 text-primary">Documentos de soporte</h1>
<h4>{{ $technology->active }}</h4>

<div class="table-responsive">
    <form method="POST" class="d-inline"  enctype="multipart/form-data" action="{{ route('technology.adjuntar', $technology->id)}}">
        @csrf
        @method('PUT')
        <input type="file" name="file_pdf[]" accept="application/pdf" required multiple>
        <div class="d-inline">
            <button class="btn btn-primary">Subir archivos</button>
        </div>
        <hr>
        <iframe src="{{ '/documentos/'.$technology->url_document }}" frameborder="0" width="100%" height="700px"></iframe>
    </form>
</div>

@endsection
