@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a>Asignaciòn de O.T Nª{{ $locative->id}} {{ $locative->order}} creada el día {{ $locative->created_at}}</a>
                </div>
                <div class="card-body">
                <form method="POST" action= "{{route('locative.update',$locative->id)}}">
                @csrf
                <div class="form-row">
                          <div class="form-group col-md-6">
                              <label>Fecha de servicio</label>
                              <input class="form-control" type="date" name="date_calendar" value="">
                          </div>
                          <div class="form-group col-md-6">
                              <label>Responsable</label>
                                <select
                                    name="assigned"
                                    class="form-control border-0 bg-light shadow-sm"
                                >
                                    <option value="">Seleccione</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->name}}"
                                        >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                          </div>
                      </div>
                      <div class="form-row mt-3">
                          <div class="row">
                            <div class="col-md-5">
                              <button type="submit" class="btn btn-primary btn-sm-2">Asignar</button>
                            </div>
                            <div class="col-md-5">
                              <a href="{{ route('locative.OT') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
                            </div>
                          </div>
                      </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

