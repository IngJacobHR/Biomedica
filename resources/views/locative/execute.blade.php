@extends('layouts.app')
  @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p>Sede {{$locative->campus->name}} {{ $locative->location}} {{ $locative->groups_id}} activo#{{ $locative->active}} tipo de falla {{ $locative->fails_id}} {{ $locative->description}} </p> 
                    </div>
                    <div class="card-body">
                    <form method="POST" action= "{{route('locative.updatesupport',$locative->id)}}">
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
                                  <input class="form-control" type="date" name="date_execute"   id="id_input" readonly value="{{ old('date_execute')?? $locative->date_execute}}">
                              </div>
                              <div>
                                  <label for="">Observacion</label>
                                <textarea class="form-control border-0 bg-light shadow-sm .id_input3"
                                id="id_input3"
                                readonly
                                
                                name="observation"
                                value="{{ old('observation')?? $locative->observation}}"
                                >{{$locative->observation}}
                                </textarea>
                              </div>
                              <div>
                                <label for="">Estado</label>
                              <textarea class="form-control border-0 bg-light shadow-sm"
                              id="id_input2"
                              readonly
                              name="evaluatión"
                              value="{{ old('evaluatión')?? $locative->evaluatión}}"
                              >{{$locative->evaluatión}}
                              </textarea>
                            </div>
                          </div>
                          <div class="form-row mt-3">
                              <div class="row">
                                <div class="col-md-5">
                                  <button type="submit" class="btn btn-primary btn-sm-2">Asignar</button>
                                </div>
                                <div class="col-md-5">   
                                  <a href="{{ route('locative.support') }}" class="btn btn-danger btn-sm-2" role="button">Cancelar</button> </a>
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


