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
                        <a class="navbar-brand" href="{{ route('technology.index') }}">Inventario</a>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="btn btn-primary btn-sm mr-sm-2" href="{{route('technology.create')}}">Crear Equipo</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="btn btn-secondary btn-sm" href="{{route('maintenance.index')}}">Programaciones</a>
                                </li>
                             </ul>
                            <form method="GET" action="{{ route('technology.index')}}" class="form-inline my-2 my-lg-0">
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
                                    <th>Serie</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Ubicacion</th>
                                    <th>Sede</th>
                                    <th>Riesgo</th>
                                    <th>ver</th>
                                    <th>editar</th>
                                    <th>Subir</th>
                                    <th>Eliminar</th>
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
                                    <td>{{ $technology->risk}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('documents.index', ['technology'=>$technology->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                          </svg></a>
                                    </td>
                                    <td>
                                        <a  class="btn btn-sm btn-outline-secondary" href="{{ route('technology.edit', ['technology'=>$technology->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                          </svg></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('documents.show', ['technology'=>$technology->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/>
                                          </svg></a>
                                    </td>
                                    <td>

                                        <form method="POST" class="d-inline" action="{{ route('technology.destroy', ['technology'=>$technology->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submint" class="btn btn-sm btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x-fill" viewBox="0 0 16 16">
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.854 7.146 8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 1 1 .708-.708z"/>
                                              </svg></button>
                                        </form>
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


