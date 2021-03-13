@extends('layouts.app')

@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h2 class="display-4">Programación de O.T. Correctivo</h2>
          <p class="lead">Las ordenes de trabajo se atenderan dependiendo la prioridad del servicio con tiempos de respuesta de 24hr para O.T -urgentes y 48 O.T -programadas</p>
        </div>
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('workorders.index') }}">Reportes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Asignadas</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link " href="{{ route('workorders.create') }}">Generar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('workorders.show') }}">Seguimiento</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Asignadas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Indicadores</a>
                </li>
              </ul>
        </div>
        <hr>

            @foreach($workorders as $work)
                <div class="accordion" id="accordion{{ $work->id}}">
                    @if($work->status=='Pendiente')
                        <div class="card">

                            <div class="card-header" id="">
                                    <div class="form-group row">
                                        <h2 class="mb-0">
                                            @if ( $work->order=='Urgente')
                                            <button class="btn btn-danger text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                                {{ $work->created_at->diffForHumans()}} O.T. Urgente en sede {{ $work->campus->name}}
                                            </button>
                                            @else
                                            <button class="btn btn-warning  text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                                {{ $work->created_at->diffForHumans()}} O.T. Programada en sede {{ $work->campus->name}}
                                            </button>
                                        @endif
                                        </h2>
                                            <input class="form-control col-md-2" type="date" name="date_calendar" value="{{ old('date_calendar')?? $work->date_calendar}}">
                                            <select class="custom-select form-control col-md-2" name="category">
                                                <option value="" selected>Responsable</option>
                                                <option>Tecnologo1</option>
                                                <option>Tecnologo2</option>
                                                <option>Tecnologo3</option>
                                            </select>
                                            <a class="btn btn-link" href="{{ route('workorders.edit', ['workorders'=>$work->id]) }}">Editar</a>
                                    </div>

                            </div>

                            <div id="collapse{{ $work->id}}" class="collapse show" aria-labelledby="" data-parent="#accordion{{ $work->id}}">
                                <div class="card-body">
                                    <p>{{ $work->equipment->name}} ubicado en {{ $work->location}} presenta {{ $work->failures->name}}. Observaciones: {{ $work->description}}</p>
                                </div>
                            </div>

                        </div>

                </div>

                @endif

            @endforeach

    </div>
    {{ $workorders->links()}}

 @endsection



