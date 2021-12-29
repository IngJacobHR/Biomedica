<div class="card-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        @can('update',new App\workorders)
        <li class="nav-item">
          <a class="nav-link " href="{{ route('indicators') }}">Indicadores</a>
        <!-- <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Indicadores</a> -->
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
  </nav>
</div>
