@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p>O.T # {{$locative->id}} {{ $locative->status}}</p> 
                </div>
                <div class="card-body">
                    <form method="POST" action=>
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label>Requerimiento</label>
                                    <p>Sede {{$locative->campus->name}} {{ $locative->location}} {{ $locative->locativegroups->name}} activo#{{ $locative->active}} tipo de falla {{ $locative->locativefails->name}} {{ $locative->description}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Observaciones</label>
                                <p value="{{ old('location')?? $locative->observation}}">{{ $locative->date_execute}}: {{ $locative->observation}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Informe</label>
                                <p value="{{ old('location')?? $locative->evaluatión}}">{{ $locative->updated_at}}: {{ $locative->evaluatión}} </p>
                            </div>
                                
                            
                            <div class="form-row mt-3">
                                <div class="row">
                                    <div class="col-md-5">   
                                    <a href="{{ route('locative.show') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
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


