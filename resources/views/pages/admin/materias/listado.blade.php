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
                    <th scope="col">Año</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>ISI</td>
                    <td>Comunicaciones</td>
                    <td>3°</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>ISI</td>
                    <td>Redes</td>
                    <td>4°</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>ISI</td>
                    <td>Entornos Gráficos</td>
                    <td>3°</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
