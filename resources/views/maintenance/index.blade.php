@extends('layouts.app')

@section('content')
    <h1 class="display-8 text-primary">Cronograma de servicios</h1>

    <nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills">
                <li  class="nav-item ">
                    <a class="btn btn-success btn-sm" href="{{ route('technology.create') }}">Crear Equipo</a>
                </li>
                <li  class="nav-item ">
                    <a class="btn btn-warning btn-sm " >Programaciones</a>
                </li>
                    <li class="nav-item">
                        <form method="GET" action="{{route('maintenance.index')}}" class="form-inline ml-2 pull-right">
                            <div class="input-group input-group-sm mt">
                                <input class="form-control form-control-navbar form-control-borderless ml-2"
                                    name="active"
                                    type="search"
                                    placeholder="activo"
                                >
                                <input class="form-control form-control-navbar form-control-borderless ml-2"
                                name="serie"
                                type="search"
                                placeholder="serie"
                                >

                                    <div class="input-group-append">
                                        <button
                                                class="btn btn-navbar btn btn-primary"
                                                type="submit">Buscar
                                        </button>
                                    </div>
                            </div>
                        </form>
                    </li>
            </ul>
        </div>
    </nav>
    <hr>
    @empty($technologies))
            <div class="alert alert-warning">
                La lista de equipos esta vacia
            </div>
        @else
            <div class="table-responsive">
                <table class= "table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Activo</th>
                            <th>Equipo</th>
                            <th>Ubicacion</th>
                            <th>Sede</th>
                            <th>Frecuencia Mant</th>
                            <th>Mantenimiento</th>
                            <th>Calibracion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technologies as $technology)
                        <tr>
                            <td>{{ $technology->active}}</td>
                            <td>{{ $technology->equipment->name}}</td>
                            <td>{{ $technology->location}}</td>
                            <td>{{ $technology->campus->name}}</td>
                            <td>
                                @if($technology->category=='R.Bajo')
                                    Correctivos
                                @elseif($technology->category=='R.Moderado')
                                    Anual
                                @elseif($technology->category=='Alto')
                                    Semestral
                                @else
                                    Cuatrimestral
                                @endif
                            </td>
                            <td>
                                {{ $technology->date_mant}}

                            </td>
                            <td>{{ $technology->date_cal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    @endempty
    {{ $technologies->links()}}
@endsection

