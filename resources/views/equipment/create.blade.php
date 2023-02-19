@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a>Crear Tecnologia</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('equipment.store')}}">
                                @csrf
                                <div class="custom-file">
                                    <input type="file" class= "form-control" name="files[]" multiple required>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label>Clasificacion Invima</label>
                                    <input class="form-control" type="text" name="class" value="{{ old('class') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria</label>
                                    <select
                                    name="category"
                                    id="category"
                                    class="custom-select"
                                    >
                                    <option value="">Seleccione</option>
                                        <option >Monitoreo</option>
                                        <option >Diagnostico</option>
                                        <option >EPP</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label>Funte de poder</label>
                                    <input class="form-control" type="text" name="powersupply" value="{{ old('powersupply') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label>Descripción</label>
                                    <input class="form-control" type="text" name="description" value="{{ old('description') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Desinfección</label>
                                        <input class="form-control" type="text" name="desinfectant" value="{{ old('desinfectant') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Crear Tecnologia</button>
                                <a class="btn btn-danger btn-lg" href="{{route('technology.index') }}">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

