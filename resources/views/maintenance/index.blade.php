@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-30">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="{{route('maintenance.index')}}">Cronograma de servicios</a>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="btn btn-primary btn-sm mr-sm-2" href="{{route('technology.index')}}">Inventario</a>
                                </li>
                            </ul>
                            <form method="GET" action="{{ route('maintenance.index')}}" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2"
                                    name="active"
                                    type="search"
                                    placeholder="Activo"
                                    aria-label="Search"
                                >
                                <input class="form-control mr-sm-2"
                                    name="serie"
                                    type="search"
                                    placeholder="Serie"
                                    aria-label="Search"
                                >
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </nav>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Activo</th>
                                    <th>Equipo</th>
                                    <th>Ubicacion</th>
                                    <th>Sede</th>
                                    <th>Frecuencia/Mant</th>
                                    <th>Mantenimiento</th>
                                    <th>Proximos/Manto</th>
                                    <th>Calibraciones</th>
                                    <th>Proximas/Cal</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($technologies as $technology)
                                <tr>
                                    <td>{{ $technology->active}}</td>
                                    <td>{{ $technology->equipment->name}}</td>
                                    <td>{{ $technology->location}}</td>
                                    <td><a href="{{route('campus.store',$technology->campus)}}">{{ $technology->campus->name}}</td>
                                    <td>
                                        @if($technology->risk=='Muy bajo')
                                            Correctivo
                                        @elseif($technology->risk=='Bajo')
                                            Anual
                                        @elseif($technology->risk=='Moderado')
                                            Semestral
                                        @else
                                            Cuatrimestral
                                        @endif
                                    </td>
                                    <td>
                                        @if($technology->risk=='Muy bajo')
                                            Correctivo
                                        @else
                                            {{ $technology->date_mant}}
                                        @endif

                                       
                                    </td>
                                    <td>
                                        @if($technology->risk=='Muy bajo')
                                            Correctivo
                                        @else
                                        {{ $technology->next_mant}}
                                        @endif
                                       
                                    </td>
                                    <td>
                                        @empty($technology->date_cal)
                                            No aplica
                                        @endempty
                                        {{ $technology->date_cal}}
                                    </td>
                                    <td>
                                        @empty($technology->date_cal)
                                            No aplica
                                        @endempty
                                        {{ $technology->next_cal}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100"></div>
    <div class="d-flex justify-content-center">
                            {{$technologies->links()}}
    </div>    
</div>

@endsection
