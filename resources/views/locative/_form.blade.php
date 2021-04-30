
<div class="form-group">
    <label for="campus_id">Sede</label>
    <select
      name="campus_id"
      id="campus_id"
      class="form-control border-0 bg-light shadow-sm"
    >
       <option value="">Seleccione</option>
       @foreach($campus_id as $id => $name)
          <option value="{{ $id }}"
          @if($id== old('campus_id',$locative->campus_id)) selected @endif
          >{{ $name }}</option>
       @endforeach
    </select>

</div>

<div class="form-group">
    <label for="location">Ubicación</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="location"
        value="{{ old('location',$locative->location)}}"
    >
</div>


<div class="form-group">
    <label for="groups_id">Tipo de Servicio</label>
    <select
      name="groups_id"
      id="groups_id"
      class="form-control border-0 bg-light shadow-sm"
    >
       <option value="">Seleccione</option>
       @foreach($groups_id as $id => $name)
          <option value="{{ $id }}"
          @if($id== old('groups_id',$locative->groups_id)) selected @endif
          >{{ $name }}</option>
       @endforeach
    </select>

</div>

<div class="form-group">
    <label for="active">Activo</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="active"
        value="{{ old('active',$locative->active)}}"
    >

</div>

<div class="form-group">
    <label for="fails_id">Falla o daño</label>
    <select
      name="fails_id"
      id="fails_id"
      class="form-control border-0 bg-light shadow-sm"
    >
       <option value="">Seleccione</option>
       @foreach($fails_id as $id => $name)
          <option value="{{ $id }}"
          @if($id== old('fails_id',$locative->fails_id)) selected @endif
          >{{ $name }}</option>
       @endforeach
    </select>

</div>

<div class="form-group">
    <label
    for="description">Descripcion de la falla
    </label>
    <textarea class="form-control border-0 bg-light shadow-sm"
         name="description"
        >{{ old('description',$locative->description)}}
    </textarea>

</div>

<div class="form-group">
    <label>Tipo de Servicio</label>
    <select class="form-control border-0 bg-light shadow-sm" name="order">
        <option value="" selected>Seleccione</option>
        <option {{ old('order') == 'Urgente' ? 'selected' : '' }} value="Urgente">Urgente</option>
        <option {{ old('order') == 'Programada' ? 'selected' : '' }} value="Programada">Programada</option>
    </select>
</div>

<button
   type="submit" class="btn btn-primary btn-lg btn-block" >{{ $btnText }}
</button>
<a class="btn btn-link btn-block"
href="{{route('workorders.index')}}">Cancelar
</a>
