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
                                            <form method="GET" action="{{ route('locative.show')}}" class="form-inline align-left my-2 my-lg-0">
                                                <select
                                                name="status"
                                                type="search"
                                                aria-label="Search"
                                                class="custom-select form-control mr-2"
                                                >
                                                <option value="">Estado</option>
                                                <option value="Terminada">Terminada</option>
                                                <option value="Evaluar">Evaluar</option>
                                                <option value="Novedad">Novedad</option>
                                                <option value="Asignada">Asignada</option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Rechazada">Rechazada</option>
                                                </select>
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
                                                <input class="form-control mr-2"
                                                name="description"
                                                type="search"
                                                aria-label="Search"
                                                placeholder="Palabra clave"
                                                aria-label="Search"
                                                >
                                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                                              </form>
                                        </div>
                                    </nav>
                                </tr>
                                <tr>
                                    <th>#O.T.</th>
                                    <th>Creaci??n</th>
                                    <th>Sede</th>
                                    <th>Descripci??n</th>
                                    <th>Responsable</th>
                                    <th>Programaci??n</th>
                                    <th>Ejecuci??n</th>
                                    <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($locative as $work)
                                    <tr>
                                        <td>{{$work->id}}</td>
                                        <td>{{$work->created_at}}</td>
                                        <td>{{$work->campus->name}}</td>
                                        <td>{{$work->description}}</td>
                                        <td>
                                            @empty($work->assigned)
                                                Sin Asignar
                                            @endempty
                                                {{$work->assigned}}
                                        </td>
                                        <td>
                                            @empty($work->date_calendar)
                                                Sin Asignar
                                            @endempty
                                            {{$work->date_calendar}}
                                        </td>
                                        <td>
                                            @if ($work->status=="Terminada")
                                                {{$work->date_execute}}
                                            @else
                                                Pendiente
                                            @endif

                                        </td>
                                        <td>
                                            @if ($work->status=="Pendiente")
                                            <a type="button" class="btn btn-warning" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
                                            @elseif($work->status=="Asignada")
                                            <a type="button" class="btn btn-primary" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
                                            @elseif($work->status=="Terminada")
                                                @if (empty($work->evaluation))
                                                    <a type="button" class="btn btn-outline-primary" href="{{ route('locative.report',$work) }}">Evaluar</a>
                                                @else
                                                    <a type="button" class="btn btn-success" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
                                                @endif
                                            @elseif($work->status=="Novedad")
                                            <a type="button" class="btn btn-danger" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
                                            @elseif($work->status=="Rechazada")
                                            <a type="button" class="btn btn-secondary" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
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
 {{-- <div class="d-flex justify-content-center">
        {{$locative->links()}}
    </div>--}}
</div>
@endsection
