@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a>Crear Equipo biomédico</a>       
                </div>
                <div class="card-body">
                   
                    @include('workorders._form', ['btnText'=>'Enviar'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

