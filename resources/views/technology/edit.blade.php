@extends('layouts.app')

@section('content')

<h1 class="display-8 text-primary">Editar equipo Biomédico</h1>

    <form method="POST" action="{{route('technology.update', ['technology'=> $technology->id])}}">
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
            <label for="equipment_id">Equipo</label>
            <select
              name="equipment_id"
              id="cequipment_id"
              class="custom-select"
            >
               <option value="">Seleccione</option>
               @foreach($equipment_id as $id => $name)
                  <option value="{{ $id }}"
                  @if($id== old('equipment_id',$technology->equipment_id)) selected @endif
                  >{{ $name }}</option>
               @endforeach
            </select>
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
                <label for="campus_id">Sede</label>
                <select
                  name="campus_id"
                  id="campus_id"
                  class="custom-select"
                >
                   <option value="">Seleccione</option>
                   @foreach($campus_id as $id => $name)
                      <option value="{{ $id }}"
                      @if($id== old('campus_id',$technology->campus_id)) selected @endif
                      >{{ $name }}</option>
                   @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Riesgo</label>
                <select
                name="risk"
                id="risk"
                class="custom-select mr-sm-2"
                >
                    <option value="">Selecionar</option>
                    @foreach(\App\Constants\TechnologyRisks::toArray() as $risk)
                        <option value="{{ $risk }}"
                        @if($risk==old("risk",$technology->risk)) selected @endif
                        >{{ $risk }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>Fecha de mantenimiento</label>
                <input class="form-control" type="date" name="date_mant" value="{{ old('date_mant')?? $technology->date_mant}}">
            </div>
            <div class="form-group col-md-5">
                <label>Fecha de Calibración</label>
                <input class="form-control" type="date"  name="date_cal" value="{{ old('date_cal')?? $technology->date_cal}}">
            </div>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Editar Equipo</button>
        </div>
    </form>

@endsection
