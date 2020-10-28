@extends('layouts.app')

@section('content')
    <h1 class="display-8 text-primary">Seguimiento de ordenes de trabajos</h1>

    <nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills">
                <li  class="nav-item ">
                    <a class="btn btn-success btn-sm" href="{{ route('workorders.create')}}">Crear Reporte</a>
                </li>
                <li  class="nav-item ">
                    <a class="btn btn-warning btn-sm " >Programaciones</a>
                </li>
                 <li class="nav-item">
                    <form method="GET" action= class="form-inline ml-2 pull-right">
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
                            <input class="form-control form-control-navbar form-control-borderless ml-2"
                                name="campus"
                                type="search"
                                placeholder="campus"
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
                <div class="table-responsive">
                    <table class= "table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Fecha de creación</th>
                                <th>Sede</th>
                                <th>Ubicación</th>
                                <th>Equipo</th>
                                <th>Activo</th>
                                <th>Serie</th>
                                <th>Daño o falla</th>
                                <th>Descripción del problema</th>
                                <th>Tipo de OT</th>
                                <th>Fecha de servicio</th>
                                <th>Aciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2020-06-05</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                     <select class="custom-select" name="category">
                                        <option value="" selected>Seleccione</option>
                                        <option {{ old('category') == 'R.Bajo' ? 'selected' : '' }} value="R.Bajo">R.Bajo</option>
                                        <option {{ old('category') == 'R.Moderado' ? 'selected' : '' }} value="R.Moderado">R.Moderado</option>
                                        <option {{ old('category') == 'R.Alto' ? 'selected' : '' }} value="R.Alto">R.Alto</option>
                                        <option {{ old('category') == 'R.Muy alto' ? 'selected' : '' }} value="R.Muy alto">R.Muy alto</option>
                                     </select</td>
                                <td>
                            </tr>
                        </tbody>
                    </table>
                </div>

    @endsection

