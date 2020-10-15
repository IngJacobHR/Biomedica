@extends('layouts.app')

@section('content')

<h1 class="display-8 text-primary">Crear equipo Biomédico</h1>

    <form method="POST" action="{{route('technology.store')}}">
        @csrf
        <div class="form-now">
            <label>Activo</label>
            <input class="form-control" type="text" name="active" value="{{ old('active') }}" >
        </div>
        <div class="form-now">
            <label>Serie</label>
            <input class="form-control" type="text" name="serie" value="{{ old('serie') }}" >
        </div>
        <div class="form-now">
            <label>Equipo</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-now">
            <label>Marca</label>
            <input class="form-control" type="text" name="mark" value="{{ old('mark') }}" >
        </div>
        <div class="form-now">
            <label>Modelo</label>
            <input class="form-control" type="text" name="model" value="{{ old('model') }}" >
        </div>
        <div class="form-now">
            <label>Ubicacion</label>
            <input class="form-control" type="text" name="location" value="{{ old('location') }}">
        </div>
        <div class="form-now">
            <label>Sede</label>
            <input class="form-control" type="text" name="campus" value="{{ old('campus') }}">
        </div>
        <div class="form-now">
            <label>Riesgo</label>
            <select class="custom-select" name="category">
                <option value="" selected>Seleccione</option>
                <option {{ old('category') == 'Sin riesgo' ? 'selected' : '' }} value="Sin riesgo">Sin Riesgo</option>
                <option {{ old('category') == 'R.Bajo' ? 'selected' : '' }} value="R.Bajo">R.Bajo</option>
                <option {{ old('category') == 'R.Moderado' ? 'selected' : '' }} value="R.Moderado">R.Moderado</option>
                <option {{ old('category') == 'R.Alto' ? 'selected' : '' }} value="R.Alto">R.Alto</option>
            </select>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
    </form>

@endsection
