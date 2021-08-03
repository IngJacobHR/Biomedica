@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p>O.T # {{$workorders->id}} {{ $workorders->status}}  
                        @isset($workorders->evaluation)
                         el servicio prestado fue {{ $workorders->evaluation}} 
                        @endisset
                    </p> 
                </div>
                <div class="card-body">
                    <form method="POST" action= "{{route('workorders.evaluation',$workorders->id)}}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label>Requerimiento</label>
                                    <p>Sede {{$workorders->campus->name}} {{ $workorders->location}} {{ $workorders->equipment->name}} activo#{{ $workorders->active}} tipo de falla {{ $workorders->failures->name}} {{ $workorders->description}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Novedad</label>
                                <p value="{{ old('location')?? $workorders->observation}}">{{ $workorders->date_novelty}}: {{ $workorders->observation}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Informe</label>
                                <p value="{{ old('location')?? $workorders->report}}">{{ $workorders->date_execute}}: {{ $workorders->report}} </p>
                            </div>
                            @can('evaluation',new App\workorders)
                            @if ($workorders->status=='Terminada'and $workorders->evaluation==Null)
                            <div class="form-group col-md-6">
                                <label for="">Calificación</label>
                                <select
                                name="evaluation"
                                id="evaluation"
                                class="form-control border-0 bg-light shadow-sm"
                            >
                                <option value="">Seleccione</option>
                                <option value="Excelente">Excelente</option>
                                <option value="Buena">Aceptable</option>
                                <option value="Mala">No Conforme</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Comentario</label>
                              <textarea class="form-control border-0 bg-light shadow-sm .id_input3"
                              id="id_input3"
                              name="commentary"
                              value=""
                              >
                              </textarea>
                            </div>
                            @endif
                            @endcan
                            @if ($workorders->evaluation=='Mala')
                            <div class="form-group col-md-6">
                                <label>Comentario</label>
                                <p>{{$workorders->date_evaluation}}: {{$workorders->commentary}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Correción</label>
                                <p>{{$workorders->updated_at}}: {{$workorders->correction}}</p>
                            </div>
                            @endif
                            <div class="form-row mt-3">
                                <div class="row">
                                    <div class="col-md-5">   
                                    <a href="{{ route('workorders.show') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</a>
                                    </div>
                                    @can('evaluation',new App\workorders)
                                    @if ($workorders->status=='Terminada'and $workorders->evaluation==Null)
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-primary btn-sm-2">Evaluar</button>
                                    </div>   
                                    @endif 
                                    @endcan      
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


