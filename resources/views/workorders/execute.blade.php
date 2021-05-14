@extends('layouts.app')
  @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p>Sede {{$workorders->campus->name}} {{ $workorders->location}} {{ $workorders->equipment->name}} activo#{{ $workorders->active}} tipo de falla {{ $workorders->failures->name}} {{ $workorders->description}} </p> 
                    </div>
                    <div class="card-body">
                    <form method="POST" action= "{{route('workorders.updatesupport',$workorders->id)}}">
                    @csrf
                    <div class="form-row">
                              <div class="form-group col-md-6">
                                <label>Estado</label>
                                  <select
                                      name="status"
                                      id="status"
                                      class="form-control border-0 bg-light shadow-sm status"
                                  >
                                      <option value="">Seleccione</option>
                                      <option value="Terminada">Terminada</option>
                                      <option value="Novedad">Novedad</option>
                                  </select>
                             </div>
                              <div class="form-group col-md-6">
                                  <label>Fecha de Novedad</label>
                                  <input class="form-control" type="date" name="date_execute"   id="id_input" readonly value="{{ old('date_execute')?? $workorders->date_execute}}">
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="">Observacion</label>
                                <textarea class="form-control border-0 bg-light shadow-sm .id_input3"
                                id="id_input3"
                                readonly
                                
                                name="observation"
                                value="{{ old('observation')?? $workorders->observation}}"
                                >{{$workorders->observation}}
                                </textarea>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="">Informe</label>
                              <textarea class="form-control border-0 bg-light shadow-sm"
                              id="id_input2"
                              readonly
                              name="evaluatión"
                              value="{{ old('evaluatión')?? $workorders->evaluatión}}"
                              >{{$workorders->evaluatión}}
                              </textarea>
                            </div>
                          </div>
                          <div class="form-row mt-3">
                              <div class="row">
                                <div class="col-md-5">
                                  <button type="submit" class="btn btn-primary btn-sm-2">Ejecutar</button>
                                </div>
                                <div class="col-md-5">   
                                  <a href="{{ route('workorders.support') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
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
  @section('js')
    <script>
           $( function() {
          $("#status").change( function() {
              if ($(this).val() === "Novedad") {
                  $("#id_input").prop("readonly", false);
                 
                 
                  $("#id_input3").prop("readonly", false);
              } else {
                  $("#id_input").prop("readonly", true);
                  
                  
                  $("#id_input3").prop("readonly", true);
              }
          });
          $("#status").change( function() {
              if ($(this).val() === "Terminada") {
                  $("#id_input2").prop("readonly", false);
                  
              } else {
           
                  $("#id_input2").prop("readonly", true);
                  
              }
          });
      });
         
    </script>         
  @endsection


