@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p>O.T # {{$workorders->id}} {{ $workorders->status}}</p> 
                </div>
                <div class="card-body">
                    <form method="POST" action=>
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label>Requerimiento</label>
                                    <p>Sede {{$workorders->campus->name}} {{ $workorders->location}} {{ $workorders->equipment->name}} activo#{{ $workorders->active}} tipo de falla {{ $workorders->failures->name}} {{ $workorders->description}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Observaciones</label>
                                <p value="{{ old('location')?? $workorders->observation}}">{{ $workorders->date_execute}}: {{ $workorders->observation}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Informe</label>
                                <p value="{{ old('location')?? $workorders->evaluatión}}">{{ $workorders->updated_at}}: {{ $workorders->evaluatión}} </p>
                            </div>
                                
                            
                            <div class="form-row mt-3">
                                <div class="row">
                                    <div class="col-md-5">   
                                    <a href="{{ route('workorders.show') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


