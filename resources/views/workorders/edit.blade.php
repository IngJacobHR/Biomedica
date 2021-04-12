

<form method="POST" action="{{route('workorders.update', ['workorders'=>$workorders->id])}}">
    @csrf
    @method('PUT')

    <div class="form-group col-md-5">
        <label>Fecha de mantenimiento</label>
        <input class="form-control" type="date" name="date_calendar" value="{{ old('date_calendar')??  $workorders->date_calendar}}">
    </div>
    <div class="form-row mt-3">
        <button type="submit" class="btn btn-primary btn-lg">Editar Equipo</button>
    </div>
</form>
