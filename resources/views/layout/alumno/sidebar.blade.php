<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Panel</div>
    <div class="list-group list-group-flush">
        <a
            href="{{ homeRoute() }}"
            class="list-group-item list-group-item-action {{ request()->is('alumno/home') ? 'active' : '' }}">
            Inicio
        </a>
      <a
          href="{{ route('alumno.perfil') }}"
          class="list-group-item list-group-item-action {{ request()->is('alumno/perfil') ? 'active' : '' }}">
          Perfil
      </a>

        <a
            href="{{ route('alumno.consultas.inscripcion') }}"
            class="list-group-item list-group-item-action {{ request()->is('alumno/consultas/inscripcion') ? 'active' : '' }}">
            Inscripción a Consulta
        </a>
    </div>
</div>
