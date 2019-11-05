@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
<div class="container">
<div class="row mt-3">
        <div class="col-md-12">
            <div class="panel panel-rigth">
                <div class="panel-body">
                    <div class="pull-left"><h3>Lista de Consultas</h3></div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Materia</th>
                                <th scope="col">Profesor</th>
                                <th scope="col">Fecha Inscripción</th>
                                <th scope="col">Fecha Consulta</th>
                                <th scope="col">Hora Consulta</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            @if($consultas->count())
                            @foreach($consultas as $consulta)
                                <tr>
                                    <td></td>
                                    <td>{{ $consulta->turno->consulta->materia->descripcion }}</th>
                                    <td>{{ $consulta->turno->consulta->profesor->apellido . ', ' . $consulta->turno->consulta->profesor->nombre }}</td>
                                    <td>{{ $consulta->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $consulta->turno->fecha_hora->format('d/m/Y') }}</th>
                                    <td>{{ $consulta->turno->fecha_hora->format('H:i')  }}</th>

                                    <td>
                                    <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No hay consultas registradas.</td>
                                </tr>
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{ $consultas->links() }}
            </div>
        </div>
</div>
</div>
@endsection
