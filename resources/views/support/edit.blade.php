@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('support.update', ['support'=> $support->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="items">Equipo</label>
                                    <select
                                    name="items_id"
                                    id="items_id"
                                    class="custom-select"
                                    >
                                    <option value="">Seleccione</option>
                                    @foreach($items_id as $id => $name)
                                        <option value="{{ $id }}"
                                        @if($id== old('items_id',$support->items_id)) selected @endif
                                        >{{ $name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="campus_id">Sede</label>
                                    <select
                                    name="campus_id"
                                    id="campus_id"
                                    class="custom-select"
                                    >
                                    <option value="">Seleccione</option>
                                     @foreach($campus_id as $id => $name)
                                        <option value="{{ $id }}"
                                        @if($id== old('campus_id',$support->campus_id)) selected @endif
                                        >{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="frequency">Frecuencia</label>
                                    <select
                                    name="frequency"
                                    id="frequency"
                                    class="custom-select"
                                    >
                                    <option value="">Seleccione</option>
                                    @foreach(\App\Constants\SupportFrequency::toArray() as $frequency)
                                        <option value="{{ $frequency }}"
                                        @if($frequency==old("frequency",$support->frequency)) selected @endif
                                        >{{ $frequency }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de mantenimiento</label>
                                    <input class="form-control" type="date" name="date_mant" value="{{ old('date_mant')?? $support->mant_calendar}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de ejecución</label>
                                    <input class="form-control" type="date" name="date_mant" value="{{ old('date_mant')?? $support->mant_execute}}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Editar Equipo</button>
                        <a class="btn btn-danger btn-lg" href="{{ route('support.index') }}">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
