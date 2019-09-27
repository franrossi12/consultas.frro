<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Panel</div>
    <div class="list-group list-group-flush">

        <a
            href="{{ route('admin.profesores') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/profesores') ? 'active' : '' }}">
            Profesores
        </a>
        <a
            href="{{ route('admin.materias') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/materias') ? 'active' : '' }}">
            Materias
        </a>
        <a
            href="{{ route('admin.consultas') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/consultas') ? 'active' : '' }}">
            Consultas
        </a>
        <a
            href="{{ route('admin.eventos') }}"
            class="list-group-item list-group-item-action {{ request()->is('admin/eventos') ? 'active' : '' }}">
            Eventos
        </a>
    </div>
</div>
