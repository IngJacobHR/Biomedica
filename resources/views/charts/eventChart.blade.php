@php
    $type=$dataType[0]['type'];
    $name=$dataType[0]['name'];
@endphp
@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white" >
                    <h2>
                        {{$name}}
                        <input type ='button' class="btn btn-success text-white float-right"  value = 'Regresar' onclick="location.href = '{{route('id', $id)}}'"/>
                        <input type ='button' class="btn btn-secondary text-white float-right mr-3"  value = 'Historico' onclick="location.href = '{{route('historic',$id)}}'"/>

                    </h2>
                </div>
                <div class="card-body">
                    <hr>
                        <form action="{{route('filterEvent', $id)}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                        <label>Fecha inicial</label>
                                        <input type="datetime-local" name="initialDate"><br>
                                        @if ($errors->has('initialDate'))
                                        <small class="form-text text-danger">{{ $errors->first('initialDate') }}</small>
                                        @endif
                                </div>

                                <div class="form-group col-md-4">
                                        <label>Fecha Final</label>
                                        <input type="datetime-local" name="finalDate"><br>
                                        @if ($errors->has('finalDate'))
                                        <small class="form-text text-danger">{{ $errors->first('finalDate') }}</small>
                                        @endif
                                </div>
                                <div class="form-group form-inline">
                                    <button type="submit" class="btn  btn-outline-success mt-3">{{ __('Filtrar') }}</button>
                                </div>
                            </div>
                        </form>
                    <hr>
                    <div class="card-body table-responsive">
                            <table class="table table-striped mt-8 text-white text-center">
                                <thead>
                                    <tr class="bg-info">
                                        <th scope="col">Medicion</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tbody class='table text-black text-center'>
                                        @foreach ($rawdata as $sensor)
                                            <tr>
                                                <td>
                                                    @if ($type == 'Temperatura')
                                                        {{$sensor->val}} °C
                                                    @elseif ($type == 'Humedad')
                                                        {{$sensor->val}} %
                                                    @elseif ($type == 'CO2')
                                                        {{$sensor->val}} ppm
                                                    @else
                                                        {{$sensor->val}}
                                                    @endif
                                                    <td>{{ $sensor->date}}</td>
                                                    <td>
                                                        @if (empty($sensor->comment))
                                                            <input type ='button' class="btn btn-info text-white btn-sm"  value = 'Comentar' onclick="location.href = '{{route('eventedit', array($sensor->id,$name))}}'"/>
                                                        @else
                                                            <input type ='button' class="btn btn-success text-white btn-sm"  value = 'Ver' onclick="location.href = '{{route('eventedit', array($sensor->id,$name))}}'"/>
                                                        @endif
                                                    </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </thead>
                            </table>

                    </div>
                </div>

            </div>
            <div class="row justify-content-center">
                {{$rawdata->links()}}
            </div>

        </div>

    </div>

</div>

@endsection
