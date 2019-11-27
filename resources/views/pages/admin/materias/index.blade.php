@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")
<div class="container">


<div class="row">
{{--    <section class="content">--}}
        <div class="col-md-12 mt-2">
            <div class="panel panel-rigth">
                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-info">
                            {{Session::get('success')}}
                        </div>
                    @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif
                    <div class="pull-left"><h3>Lista de Materias</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('materias.create') }}" class="btn btn-info" width="100%" >Añadir Materia</a>
                            </div>
                        </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped table-responsive">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Carrera</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                            @if($materias->count())
                            @foreach($materias as $materia)
                                <tr>
                                <td>{{ $materia->id }}</th>
                                <td>{{ $materia->descripcion }}</td>
                                <td>{{ $materia->carrera->descripcion }}</td>

                                <td><a class="btn btn-primary btn-xs" href="{{action('MateriaController@edit', $materia->id)}}" ><span class="fa fa-pen"></span></a></td>
                                <td>
                                <form action="{{action('MateriaController@destroy', $materia->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay materias registradas.</td>
                                </tr>
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{ $materias->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
