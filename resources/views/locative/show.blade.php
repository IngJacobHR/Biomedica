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
                                    <th>#O.T. </th>
                                    <th>Sede</th>
                                    <th>Equipo</th>
                                    <th>Responsable</th>
                                    <th>Fecha de Programaciòn</th>
                                    <th>Fecha de Ejecución</th>
                                    <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($locative as $work)
                                    <tr>
                                        <td>{{$work->id}}</td>
                                        <td>{{$work->campus->name}}</td>
                                        <td>{{$work->locativegroups->name}}</td>
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
                                                {{$work->updated_at}}
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
                                            <a type="button" class="btn btn-success" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
                                            @elseif($work->status=="Novedad")
                                            <a type="button" class="btn btn-danger" href="{{ route('locative.report',$work) }}">{{$work->status}}</a>
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
