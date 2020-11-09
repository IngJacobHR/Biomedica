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
                  <a class="nav-link " href="{{ route('workorders.create') }}">Generar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Seguimiento</a>
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

                    <div class="card">

                        <div class="card-header" id="">

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
                        </div>

                        <div id="collapse{{ $work->id}}" class="collapse show" aria-labelledby="" data-parent="#accordion{{ $work->id}}">
                            <div class="card-body">
                                <p>{{ $work->equipment->name}} ubicado en {{ $work->location}} presenta {{ $work->failures->name}}. Observaciones: {{ $work->description}}</p>
                                <a class="btn btn-success" href=>Programar</a>
                                <a class="btn btn-link" href=>Cerrar</a>
                            </div>
                        </div>

                    </div>

            </div>
        @endforeach

    </div>
    {{ $workorders->links()}}

 @endsection



