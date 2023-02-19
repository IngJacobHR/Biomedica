@extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" >
                    <h2>{{ $dataType[0]['name'] }}</h2>
                </div>
                 <div class='card-body'>
                     <form action="{{route('eventupdate', $id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                           <div class="mb-3">
                             <label for="" class="form-label">Novedad del evento</label>
                             <textarea type="text" name="comment" class="form-control"> {{$rawdata[0]->comment}} </textarea>
                        </div>

                        <button type='submit' class='btn btn-success'>Confirmar</button>
                        <a href={{ url()->previous() }} class="btn btn-danger" >Cancelar</a>
                     </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
