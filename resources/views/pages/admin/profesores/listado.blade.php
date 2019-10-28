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
                @foreach($profesores as $profesor)
                <tbody>
                <tr>
                    <th scope="row">{{ $profesor->id }}</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>text@gmail.com</td>
                </tr>
                </tbody>
                @endforeach
            </table>
            {{ $profesor->links() }}
            </div>
        </div>
    </div>
@endsection
