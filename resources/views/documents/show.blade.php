@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cargar Documentos') }}</div>

                <div class="card-body">
                     <form method="POST" action="{{ route('documents.store', $technology->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class= "form-control" name="files[]" multiple required>
                        <div>
                        <button type="submit" class="btn-link btn float-right">Subir</button>
                        <a class="btn-link btn float-right"
                        href="{{route('technology.index')}}">Cancelar
                        </a>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
