<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Panel</div>
    <div class="list-group list-group-flush">

      <a
          href="{{ route('alumno.perfil') }}"
          class="list-group-item list-group-item-action {{ request()->is('alumno/perfil') ? 'active' : '' }}">
          Perfil
      </a>

    </div>
</div>
