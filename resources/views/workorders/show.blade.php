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
                  <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Indicadores</a>
                </li>
              </ul>
        </div>
        <hr>
        @foreach($workorders as $work)
            <div class="accordion" id="accordion{{ $work->id}}">

                    <div class="card">

                        <div class="card-header" id="">
                            <form method="POST" action="{{route('workorders.show', $work->id)}}">
                                @csrf
                                <div class="form-group row">
                                    <h2 class="mb-0">
                                        @if ( $work->status=='Pendiente')
                                        <button class="btn btn-warning text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                             O.T.#{{ $work->id}} {{ $work->status}}
                                        </button>
                                        @elseif( $work->status=='Novedad')
                                        <button class="btn btn-danger  text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                            O.T.# {{ $work->id}} {{ $work->status}}
                                        </button>
                                        @elseif( $work->status=='Terminada')
                                        <button class="btn btn-success  text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                            O.T.# {{ $work->id}} {{ $work->status}}
                                        </button>
                                        @elseif( $work->status=='Asignada')
                                        <button class="btn btn-info  text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $work->id}}" aria-expanded="false" aria-controls="collapse{{ $work->id}}">
                                            O.T.# {{ $work->id}} {{ $work->status}}
                                        </button>
                                    @endif
                                    </h2>
                                    <div class="form-group col-md-5">
                                        <label>Fecha estimada de servicio</label>
                                        <input class="form-control col-md-4" type="date" name="date_mant" value="{{ old('date_mant') }}">
                                    </div>


                                    <button type="submint" class="btn btn-link">Aceptar</button>

                                 </div>
                            </form>

                        </div>

                        <div id="collapse{{ $work->id}}" class="collapse show" aria-labelledby="" data-parent="#accordion{{ $work->id}}">
                            <div class="card-body">
                                <p>{{ $work->equipment->name}} ubicado en {{ $work->location}} presenta {{ $work->failures->name}}. Observaciones: {{ $work->description}}</p>
                            </div>
                        </div>

                    </div>

            </div>
        @endforeach

    </div>
    {{ $workorders->links()}}

 @endsection



