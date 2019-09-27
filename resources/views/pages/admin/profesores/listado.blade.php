@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")

<div class="row mt-3">
        <div class="col-md-8 col-xs-12 col-sm-12">
            <h2>Listado de Profesores</h2>
            <br>
            <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>text@gmail.com</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>text@gmail.com</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>text@gmail.com</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
