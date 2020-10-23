@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="display-8 text-primary">Documentos de soporte</h1>
  <h4></h4>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Ver</th>
                                  <th scope="col">Elimiar</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->name }}</td>
                                    <td>
                                        <a href="storage/{{ Auth::id() }}/{{ $file->name }}" class="btn btn-sm btn-outline-secondary">
                                            Ver
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-outline-danger">
                                            Eliminar
                                        </a>
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
