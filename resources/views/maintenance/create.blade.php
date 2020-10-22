@extends('layouts.app')

@section('content')

<form>
    @csrf
    @method('PUT')
    <div class="form-row">
        <div class="form-group col-md-6">
          <label>Activo</label>
          <input class="form-control" type="text" name="active" value="{{old('active')?? $technology->active}}">
        </div>
        <div class="form-group col-md-6">
          <label>Serie</label>
          <input class="form-control" type="text" name="serie" value="{{ old('serie')?? $technology->serie}}">
        </div>
      </div>
    <div class="form-group">
        <label>Equipo</label>
        <input class="form-control" type="text" name="name" value="{{ old('name')??$technology->name}}">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
          <label>Marca</label>
          <input class="form-control" type="text" name="mark" value="{{ old('mark')?? $technology->mark}}">
        </div>
        <div class="form-group col-md-6">
          <label>Modelo</label>
          <input class="form-control" type="text" name="model" value="{{ old('model')?? $technology->model}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
          <label>Ubicación</label>
          <input class="form-control" type="text" name="location" value="{{ old('location')?? $technology->location}}">
        </div>
        <div class="form-group col-md-5">
            <label>Sede</label>
            <input class="form-control" type="text" name="campus" value="{{ old('campus')?? $technology->campus}}">
        </div>
        <div class="form-group col-md-2">
            <label>Riesgo</label>
            <select class="custom-select" name="category" >
                <option {{old('category') == 'R.Bajo' ? 'selected' : ($technology->category == 'R.Bajo' ? 'selected': '')}} value="R.Bajo">R.Bajo</option>
                <option {{old('category') == 'R.Moderado' ? 'selected' : ($technology->category == 'R.Moderado' ? 'selected': '')}} value="R.Moderado">R.Moderado</option>
                <option {{old('category') == 'R.Alto' ? 'selected' : ($technology->category == 'R.Alto' ? 'selected': '')}} value="R.Alto">R.Alto</option>
                <option {{old('category') == 'R.Muy alto' ? 'selected' : ($technology->category == 'R.Muy alto'? 'selected': '')}} value="R.Muy alto">R.Muy alto</option>
            </select>
        </div>
    </div>
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
    <div class="form-row mt-3">
        <button type="submit" class="btn btn-primary btn-lg">Editar Equipo</button>
    </div>
</form>

@endsection
