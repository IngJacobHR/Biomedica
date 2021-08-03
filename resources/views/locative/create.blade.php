@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form class="bg-white py-3 px-4 shadow rounded"
            method="POST"
            action="{{route('locative.store')}}">
            @csrf
            <h1 class="display-8">Nuevo
            Reporte Locativo</h1>
            <hr>

            @include('locative._form', ['btnText'=>'Enviar'])
            </form>
        </div>
    </div>
</div>
@endsection
