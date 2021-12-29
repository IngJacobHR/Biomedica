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
                        <a class="navbar-brand" href="{{route('maintenance.index')}}"></a>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li>
                                    <form method="GET" action="{{ route('maintenance.index')}}" class="form-inline my-2 my-lg-0">
                                        <input class="form-control mr-2"
                                        name="active"
                                        type="search"
                                        placeholder="Activo"
                                        aria-label="Search"
                                        >

                                        <input class="form-control mr-2"
                                        name="serie"
                                        type="search"
                                        placeholder="Serie"
                                        aria-label="Search"
                                        >
                                        <select
                                        name="campus_id"
                                        type="search"
                                        id="campus_id"
                                        class="custom-select form-control mr-2"
                                        >
                                        <option value="">Sede</option>
                                        @foreach($campus_id as $id => $name)
                                            <option value="{{ $id }}"
                                            @if($id== old('campus_id')) selected @endif
                                            >{{ $name }}</option>
                                        @endforeach
                                         </select>
                                        <select
                                        name="equipment_id"
                                        type="search"
                                        id="equipment_id"
                                        class="custom-select form-control mr-2"
                                        >
                                        <option value="">Equipo</option>
                                        @foreach($equipment_id as $id => $name)
                                        <option value="{{$id}}"
                                        >{{ $name }}</option>
                                        @endforeach
                                        </select>
                                        <select name="metrologic" class="custom-select form-control mr-2 my-2">
                                            <option value="">Busqueda</option>
                                            <option value="Calibración">Calibración</option>
                                            <option value="Mantenimiento">Mantenimiento</option>
                                        </select>
                                        <select name="programation" class="custom-select form-control mr-2 my-2">
                                            <option value="">Programación</option>
                                            <option value="Vencidos">Vencidos</option>
                                            <option value="Por vencer">Por vencer</option>
                                        </select>
                                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>

                                    </form>

                                </li>
                            </ul>
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
                                        @php
                                            $now1 = (strtotime($technology->next_mant) - strtotime($now))/86400;
                                            $now2 = (strtotime($technology->next_cal) - strtotime($now))/86400;
                                        @endphp
                                        @if($technology->risk=='Muy bajo')
                                            Correctivo
                                        @else
                                            @if($now1 < 1 )
                                                <p class="text-danger">{{ $technology->date_mant}}</p>
                                            @elseif($now1 >= 1 && $now1 <= 30 )
                                                <p class="text-warning">{{ $technology->date_mant}}</p>
                                            @else
                                                <p class="text-black">{{ $technology->date_mant}}</p>
                                            @endif
                                        @endif


                                    </td>
                                    <td>
                                        @if($technology->risk=='Muy bajo')
                                            Correctivo
                                        @else
                                            @if($now1 < 1)
                                                <p class="text-danger">{{ $technology->next_mant}}</p>
                                            @elseif($now1 >= 1 && $now1 <= 30 )
                                                <p class="text-warning">{{ $technology->next_mant}}</p>
                                            @else
                                                <p class="text-black">{{ $technology->next_mant}}</p>
                                            @endif
                                        @endif

                                    </td>
                                    <td>
                                        @empty($technology->date_cal)
                                            No aplica
                                        @endempty
                                        @if($now2 < 1)
                                            <p class="text-danger">{{ $technology->date_cal}}</p>
                                        @elseif($now2 >= 1 && $now2 <= 30 )
                                            <p class="text-warning">{{ $technology->date_cal}}</p>
                                        @else
                                            <p class="text-black">{{ $technology->date_cal}}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @empty($technology->date_cal)
                                            No aplica
                                        @endempty
                                        @if($now2 < 1)
                                            <p class="text-danger">{{ $technology->next_cal}}</p>
                                        @elseif($now2 >= 1 && $now2 <= 30 )
                                            <p class="text-warning">{{ $technology->next_cal}}</p>
                                        @else
                                            <p class="text-black">{{ $technology->next_cal}}</p>
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
    <div class="w-100"></div>
    <div class="d-flex justify-content-center">
                            {{$technologies->links()}}
    </div>
</div>
@endsection
@section('js')
    @if (Auth::user()->roles == "Manager")
        @if (($metrologic == "Calibración") && ($programation == "Por vencer"))
            <script>
                Swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        text: 'Calibraciones por vencer: ' + "<?php echo $calibration; ?>",
                        confirmButtonText: "Aceptar"})
            </script>
        @elseif(($metrologic == "Calibración") && ($programation == "Vencidos"))
            <script>
                Swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        text: 'Calibraciones vencidas: ' + "<?php echo $calibration; ?>",
                        confirmButtonText: "Aceptar"})
            </script>
        @elseif(($metrologic == "Mantenimiento") && ($programation == "Por vencer"))
            <script>
                Swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        text: 'Mantenimientos por vencer: ' + "<?php echo $maintenance; ?>",
                        confirmButtonText: "Aceptar"})
            </script>
        @elseif(($metrologic == "Mantenimiento") && ($programation == "Vencidos"))
            <script>
                Swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        text: 'Mantenimientos vencidos: ' + "<?php echo $maintenance; ?>",
                        confirmButtonText: "Aceptar"})
            </script>
        @else
            <script>
                Swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        text: 'Mantenimientos vencidos: ' + "<?php echo $maintenance; ?>" + 'Calibraciones vencidas: ' + "<?php echo $calibration; ?>",
                        confirmButtonText: "Aceptar"})
            </script>
        @endif
    @endif


@endsection
