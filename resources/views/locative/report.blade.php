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
                    <form method="POST"  action= "{{route('locative.evaluation',$locative->id)}}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label>Requerimiento</label>
                                    <p>Sede {{$locative->campus->name}} {{ $locative->location}} {{ $locative->locativegroups->name}} activo#{{ $locative->active}} tipo de falla {{ $locative->locativefails->name}} {{ $locative->description}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Novedad</label>
                                <p value="{{ old('location')?? $locative->observation}}">{{ $locative->date_novelty}}: {{ $locative->observation}} </p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Informe</label>
                                <p value="{{ old('location')?? $locative->report}}">{{ $locative->date_execute}}: {{ $locative->report}} </p>
                            </div>
                            @can('evaluation',new App\workorders)
                            @if ($locative->status=='Terminada'and $locative->evaluation==Null)
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
                            @if ($locative->evaluation=='Mala')
                            <div class="form-group col-md-6">
                                <label>Comentario</label>
                                <p>{{$locative->date_evaluation}}: {{$locative->commentary}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Correción</label>
                                <p>{{$locative->updated_at}}: {{$locative->correction}}</p>
                            </div>
                            @endif    
                            
                            <div class="form-row mt-3">
                                <div class="row">
                                    <div class="col-md-5">   
                                    <a href="{{ route('locative.show') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
                                    </div>
                                    @can('evaluation',new App\workorders)
                                    @if ($locative->status=='Terminada'and $locative->evaluation==Null)
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


