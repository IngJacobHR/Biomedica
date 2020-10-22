@extends('layouts.app')

@section('content')

<h1 class="display-8 text-primary">Crear equipo Biomédico</h1>

    <form method="POST" action="{{route('technology.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Activo</label>
              <input class="form-control" type="text" name="active" value="{{ old('active') }}">
            </div>
            <div class="form-group col-md-6">
              <label>Serie</label>
              <input class="form-control" type="text" name="serie" value="{{ old('serie') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Equipo</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Marca</label>
              <input class="form-control" type="text" name="mark" value="{{ old('mark') }}">
            </div>
            <div class="form-group col-md-6">
              <label>Modelo</label>
              <input class="form-control" type="text" name="model" value="{{ old('model') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
              <label>Ubicación</label>
              <input class="form-control" type="text" name="location" value="{{ old('location') }}">
            </div>
            <div class="form-group col-md-5">
                <label>Sede</label>
                <input class="form-control" type="text" name="campus" value="{{ old('campus') }}">
            </div>
            <div class="form-group col-md-2">
                <label>Riesgo</label>
                <select class="custom-select" name="category">
                    <option value="" selected>Seleccione</option>
                    <option {{ old('category') == 'R.Bajo' ? 'selected' : '' }} value="R.Bajo">R.Bajo</option>
                    <option {{ old('category') == 'R.Moderado' ? 'selected' : '' }} value="R.Moderado">R.Moderado</option>
                    <option {{ old('category') == 'R.Alto' ? 'selected' : '' }} value="R.Alto">R.Alto</option>
                    <option {{ old('category') == 'R.Muy alto' ? 'selected' : '' }} value="R.Muy alto">R.Muy alto</option>
                </select>
            </div>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>

    </form>

@endsection
