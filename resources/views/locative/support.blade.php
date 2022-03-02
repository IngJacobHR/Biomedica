@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('workorders._nav')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                            <form method="GET" action="{{ route('locative.support')}}" class="form-inline align-left my-2 my-lg-0">
                                                <select
                                                name="campus_id"
                                                type="search"
                                                id="campus_id"
                                                class="custom-select form-control mr-2"
                                                >
                                                <option value="">Sede</option>
                                                    @foreach($campus as $id => $name)
                                                        <option value="{{ $id }}"
                                                        @if($id== old('campus_id')) selected @endif
                                                        >{{ $name }}</option>
                                                    @endforeach
                                                </select>


                                                <input type="text" name="initialDate" placeholder="Fecha inicial"  onfocus="(this.type='date')" onblur="(this.type='text')" class="custom-select form-control mr-2">
                                                <input type="text" name="finalDate" placeholder="Fecha Final"  onfocus="(this.type='date')" onblur="(this.type='text')" class="custom-select form-control mr-2">

                                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                                              </form>
                                        </div>
                                    </nav>
                                    <th>#O.T. </th>
                                    <th>Fecha de creación</th>
                                    <th>Sede</th>
                                    <th>Ubicación</th>
                                    <th>Equipo</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Programación</th>
                                    <th>Ejecutar</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($locative as $work)
                                    <tr>
                                        <td>{{$work->id}}</td>
                                        <td>{{$work->created_at}}</td>
                                        <td>{{$work->campus->name}}</td>
                                        <td>{{$work->location}}</td>
                                        <td>{{$work->locativegroups->name}}</td>
                                        <td>{{$work->description}}</td>
                                        <td>{{$work->date_calendar}}</td>
                                        <td>
                                            @if ($work->order=="Programada")
                                            <a class="btn btn-sm btn-outline-warning" href="{{ route('locative.execute',$work) }}">Ejecutar<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                                <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
                                              </svg></a>
                                            @elseif($work->order=="Urgente")
                                            <a class="btn btn-sm btn-outline-danger"  href="{{ route('locative.execute',$work) }}">Ejecutar<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                                <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
                                              </svg></a>
                                            @endif
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
</div>
@endsection
