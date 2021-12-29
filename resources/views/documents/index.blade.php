@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('documents.file',[$info])}}">DOCUMENTOS DE SOPORTE:  {{ $info->equipment->name}} {{ $info->active }}</a>
                    <a class="btn btn-primary btn-sm mr-sm-4" href="{{route('technology.index')}}">Regresar</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Ver</th>
                                  @can('delete',new App\documents)
                                  <th scope="col">Elimiar</th>
                                  @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td>
                                            {{ $file->name }}
                                         </td>
                                        <td>
                                            <a target="_blank" href="/biomedica/storage/app/public/documents/{{$file->technology_id}}/{{$file->name}}" class="btn btn-sm btn-outline-secondary">
                                                    Ver
                                             </a>
                                        </td>
                                        @can('delete',new App\documents)
                                        <td>
                                             <form action="{{route ('documents.destroy',$file->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"> Eliminar</button>
                                             </form>
                                        </td>
                                        @endcan
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
