
<div class="form-group">
    <label for="campus_id">Sede</label>
    <select
      name="campus_id"
      id="campus_id"
      class="form-control border-0 bg-light shadow-sm"
    >
       <option value="">Seleccione</option>
       @foreach($campus as $id => $name)
          <option value="{{ $id }}"
          @if($id== old('campus_id',$workorders->campus_id)) selected @endif
          >{{ $name }}</option>
       @endforeach
    </select>

</div>

<div class="form-group">
    <label for="location">Ubicación</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="location"
        value="{{ old('location',$workorders->location)}}"
    >
</div>

<div class="form-group">
    <label for="name">Equipo</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="name"
        value="{{ old('name',$workorders->name)}}"
    >

</div>

<div class="form-group">
    <label for="active">Activo</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="active"
        value="{{ old('active',$workorders->active)}}"
    >

</div>

<div class="form-group">
    <label for="url">Serie</label>
    <input class="form-control border-0 bg-light shadow-sm"
        type="text"
        name="serie"
        value="{{ old('serie',$workorders->serie)}}"
    >

</div>

<div class="form-group">
    <label for="failures_id">Falla o daño</label>
    <select
      name="failures_id"
      id="failures_id"
      class="form-control border-0 bg-light shadow-sm"
    >
       <option value="">Seleccione</option>
       @foreach($failures as $id => $name)
          <option value="{{ $id }}"
          @if($id== old('failures_id',$workorders->failures_id)) selected @endif
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
        >{{ old('description',$workorders->description)}}
    </textarea>

</div>

<button
    class="btn btn-primary btn-lg btn-block">{{ $btnText }}
</button>
<a class="btn btn-link btn-block"
href="{{ route('workorders.index') }}">Cancelar
</a>
