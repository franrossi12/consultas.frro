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
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Comunicaciones</td>
                    <td>Profesor Test</td>
                    <td>Lunes</td>
                    <td>14:00</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Redes</td>
                    <td>Profesor Test</td>
                    <td>Martes</td>
                    <td>14:00</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Entornos Gráficos</td>
                    <td>Profesor Test</td>
                    <td>Jueves</td>
                    <td>14:00</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
