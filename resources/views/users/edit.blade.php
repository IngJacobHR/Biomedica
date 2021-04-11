@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form "bg-white shadow rounded py-3 px-4" method="POST" action="{{route('users.update',$usuario)}}">
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
                    <select class="custom-select form-control" name="admin_since" >
                        <option {{old('admin_since') == 'S.Admin' ? 'selected' : ($usuario->admin_since == 'S.Admin' ? 'selected': '')}} value="S.Admin">S.Admin</option>
                        <option {{old('admin_since') == 'Admin' ? 'selected' : ($usuario->admin_since == 'Admin' ? 'selected': '')}} value="Admin">Admin</option>
                        <option {{old('admin_since') == 'Usuario' ? 'selected' : ($usuario->admin_since == 'Usuario' ? 'selected': '')}} value="Usuario">Usuario</option>
                    </select>
                <div class="form-group form-check">
                  <input name="enabled_user" type="checkbox" class="form-check-input" id="exampleCheck1" @if ($usuario->enabled_user)
                  checked @endif>
                  <label class="form-check-label" for="exampleCheck1">Habilitado</label>
                </div>
                <button type="submit" class="btn btn-danger">Modificar</button>
                <a class="btn btn-success" href="{{ URL::previous() }}">Salir</a>
              </form>
        </div>
    </div>
  </div>

@endsection
