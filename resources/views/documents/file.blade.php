@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p>Ficha de identificación</p>
                </div>
                <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label>Equipo:</label>
                                    <p>{{ $info->equipment->name}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Marca</label>
                                <p>{{ $info->mark}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>modelo</label>
                                <p>{{ $info->model}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Activo</label>
                                <p>{{ $info->active}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Serie</label>
                                <p>{{ $info->serie}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Clasificación</label>
                                <p>{{ $info->equipment->class}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sede</label>
                                <p>{{ $info->campus->name}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ubicación</label>
                                <p>{{ $info->location}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Riesgo</label>
                                <p>{{ $info->risk}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Fr. Mantenimiento</label>
                                <p>
                                    @if($info->risk=='Muy bajo')
                                            Correctivo
                                        @elseif($info->risk=='Bajo')
                                            Anual
                                        @elseif($info->risk=='Moderado')
                                            Semestral
                                        @else
                                            Cuatrimestral
                                        @endif
                                </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Mantenimiento</label>
                                <p> @if($info->risk=='Muy bajo')
                                    Correctivo
                                @else
                                    {{ $info->date_mant}}
                                @endif</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Proximo Mantenimiento</label>
                                <p> @if($info->risk=='Muy bajo')
                                    Correctivo
                                @else
                                    {{ $info->next_mant}}
                                @endif</p>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


