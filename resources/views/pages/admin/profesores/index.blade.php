@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")
<div class="container">


<div class="row">
{{--    <section class="content">--}}
        <div class="col-md-12">

            <div class="panel panel-rigth mt-2">
                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-info mt-2">
                            {{Session::get('success')}}
                        </div>
                    @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger mt-2">
                                {{Session::get('error')}}
                            </div>
                        @endif
                    <div class="pull-left"><h3>Lista de Profesores</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('profesores.create') }}" class="btn btn-info" width="100%" >Añadir Profesor</a>
                            </div>
                        </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped table-responsive">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Email</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                            @if($profesores->count())
                            @foreach($profesores as $profesor)
                                <tr>
                                <td>{{ $profesor->id }}</th>
                                <td>{{ $profesor->nombre }}</td>
                                <td>{{ $profesor->apellido }}</td>
                                <td>{{ $profesor->email }}</td>
                                <td><a class="btn btn-primary btn-xs" href="{{action('ProfesorController@edit', $profesor->id)}}" ><span class="fa fa-pen"></span></a></td>
                                <td>
                                <form action="{{action('ProfesorController@destroy', $profesor->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit">
                                    <span class="fa fa-trash"></span>
                                </button>
                                </form>
                                </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay profesores registrados.</td>
                                </tr>
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{ $profesores->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
