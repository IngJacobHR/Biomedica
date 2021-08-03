@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Lista de Usiarios y Roles') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <form class="bg-white shadow rounded py-3 px-4" method="POST" action="{{route('users.update',$usuario)}}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                <label><strong>Actualizar Nombre</strong></label>
                                <input name="name" type="text" class="form-control bg-light shadow-sm"
                                    value="{{$usuario->name}}">
                                    @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Rol</strong></label>
                                    <select class="custom-select form-control" name="roles" >
                                    <option value="">Selecionar</option>
                                    @foreach(\App\Constants\UserRoles::toArray() as $roles)
                                        <option value="{{ $roles }}"
                                        @if($roles==old("roles",$usuario->roles)) selected @endif
                                        >{{ $roles }}</option>
                                    @endforeach
                                    </select>
                                <div class="form-group form-check">
                                <input name="enabled_user" type="checkbox" class="form-check-input" id="exampleCheck1" @if ($usuario->enabled_user)
                                checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Habilitado</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Modificar</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Salir</a>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
