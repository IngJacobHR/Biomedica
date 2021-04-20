@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('workorders.create') }}">Generar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('workorders.index') }}">Reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Asignadas</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('workorders.show') }}">Seguimiento</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Indicadores</a>
                        </li>
                      </ul>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#O.T. </th>
                                    <th>Sede</th>
                                    <th>Equipo</th>
                                    <th>Responsable</th>
                                    <th>Fecha de Programaciòn</th>
                                    <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($workorders as $work)
                                    <tr>
                                        <td>{{$work->id}}</td>
                                        <td>{{$work->campus->name}}</td>
                                        <td>{{$work->equipment->name}}</td>
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
                                            @if ($work->status=="Pendiente")
                                            <a type="button" class="btn btn-warning">{{$work->status}}</a>
                                            @elseif($work->status=="Asignada")
                                            <a type="button" class="btn btn-primary">{{$work->status}}</a>
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
