@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")

<div class="row mt-3">
        <div class="col-md-8 col-xs-12 col-sm-12">
            <h2>Listado de Materias</h2>
            <br>
            <div class="table-responsive">
            <table class="table ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Materia</th>
              {{--  <th scope="col">Año</th>   --}}
                </tr>
                </thead>
                @foreach($materias as $materia)
                <tbody>
                <tr>
                    <th scope="row">{{ $materia->id }}</th>
                    <td>{{ $materia->carrera->descripcion }}</td>
                    <td>{{ $materia->descripcion }}</td>
                {{--       <td>3°</td> --}}
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $materias->links() }}
            </div>
        </div>
    </div>
@endsection
