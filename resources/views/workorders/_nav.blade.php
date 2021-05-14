<div class="card-header">
  <ul class="nav nav-tabs">
    @can('update',new App\workorders)
    <li class="nav-item">
      <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Indicadores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('workorders.OT') }}">Reportes</a>
    </li>
    @endcan
    @can('restore',new App\workorders)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('workorders.support') }}">Asignadas</a>
    </li>
    @endcan
    @can('create',new App\workorders)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('workorders.show') }}">Review Biomédica</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('workorders.create') }}">OT.Biomédica</a>
    </li>  
    @endcan   

    @can('update',new App\Locative)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('locative.OT') }}">Reportes</a>
    </li> 
    <li class="nav-item">
      <a class="nav-link" href="{{ route('locative.support') }}">Asignadas</a>
    </li>
    @endcan
    @can('create',new App\Locative)
    <li class="nav-item">
      <a class="nav-link" href="{{ route('locative.show') }}">Review Locativa</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('locative.create') }}">OT.Locativa</a>
    </li> 
    @endcan  
    
  </ul>
</div> 