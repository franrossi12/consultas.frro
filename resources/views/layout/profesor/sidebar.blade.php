<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Panel</div>
    <div class="list-group list-group-flush">
        <a
            href="{{ homeRoute() }}"
            class="list-group-item list-group-item-action {{ request()->is('profesor/home') ? 'active' : '' }}">
            Inicio
        </a>
        <a
            href="{{ route('profesor.perfil') }}"
            class="list-group-item list-group-item-action {{ request()->is('profesor/perfil') ? 'active' : '' }}">
            Perfil
        </a>
        <a
            href="{{ route('profesor.consultas.listado') }}"
            class="list-group-item list-group-item-action {{ request()->is('profesor/consultas/listado') ? 'active' : '' }}">
            Listado de Consultas
        </a>
        <a
            href="{{ route('profesor.consultas.cancelar') }}"
            class="list-group-item list-group-item-action {{ request()->is('profesor/consultas/cancelar') ? 'active' : '' }}">
            Cancelar consultas futuras
        </a>
    </div>
</div>
