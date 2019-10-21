@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")
<div class="row mt-3">
        <div class="col-md-8 col-xs-12 col-sm-12">
            <h2>Listado de Consultas</h2>
            <br>
            <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Profesor</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Hora</th>
                </tr>
              </thead>
                @foreach($consultas as $consulta)
                <tbody>
                <tr>
                    <th scope="row">{{ $consulta->id }}</th>
                    <td>{{ $consulta->materia->descripcion }}</td>
                    <td>{{ $consulta->profesor->nombre }}</td>
                    <td>{{ $dias->where('numero', $consulta->numero_dia)->first()->descripcion}}</td>
                    <td>{{ $consulta->hora }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $consultas->links() }}
            </div>
        </div>
    </div>
@endsection
