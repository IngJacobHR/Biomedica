@extends('layouts.app')

@section('content')
    <h1 class="display-8 text-primary">Inventario Coopsana ips</h1>

    <nav class="navbar  navbar-light navbar-expand-lg bg-white shadow-sm">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills">
                <li  class="nav-item ">
                    <a class="btn btn-success btn-sm" href="{{ route('technology.create') }}">Crear Equipo</a>
                </li>
                <li  class="nav-item ">
                    <a class="btn btn-warning btn-sm " >Programaciones</a>
                </li>
                    <li class="nav-item">
                        <form method="GET" action="{{ route('technology.index')}}" class="form-inline ml-2 pull-right">
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
                            <th>Serie</th>
                            <th>Equipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ubicacion</th>
                            <th>Sede</th>
                            <th>Riesgo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technologies as $technology)
                        <tr>
                            <td>{{ $technology->active}}</td>
                            <td>{{ $technology->serie}}</td>
                            <td>{{ $technology->equipment->name}}</td>
                            <td>{{ $technology->mark}}</td>
                            <td>{{ $technology->model}}</td>
                            <td>{{ $technology->location}}</td>
                            <td><a href="{{route('campus.show',$technology->campus)}}">{{ $technology->campus->name}}</a></td>
                            <td>{{ $technology->category}}</td>
                            <td>
                                <a class="btn btn-link" href="{{ route('documents.index', ['technology'=>$technology->id]) }}">Ver</a>
                                <a class="btn btn-link" href="{{ route('technology.edit', ['technology'=>$technology->id]) }}">Editar</a>
                                <a class="btn btn-link" href="{{ route('documents.show', ['technology'=>$technology->id]) }}">Documentacion</a>
                                <form method="POST" class="d-inline" action="{{ route('technology.destroy', ['technology'=>$technology->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submint" class="btn btn-link">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    @endempty
    {{ $technologies->links()}}
@endsection

