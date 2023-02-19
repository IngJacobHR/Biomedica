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
                        <div class="mb-3">
                             Fecha del comentario: {{$rawdata[0]->updated_at}}
                             <br>
                             Comentario: {{$rawdata[0]->comment}}
                        </div>
                        <a href={{ url()->previous() }} class="btn btn-danger" >Regresar</a>
                     </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
