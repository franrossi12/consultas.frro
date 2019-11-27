@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection

@section("content")
<div class="container">


<div class="row mt-2">
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
                            <div class="alert alert-danger mt-2">
                                {{Session::get('error')}}
                            </div>
                        @endif
                    <div class="pull-left"><h3>Lista de Consultas</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('consultas.create') }}" class="btn btn-info" width="100%" >Añadir Consulta</a>
                            </div>
                        </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped table-responsive">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Materia</th>
                                <th scope="col">Profesor</th>
                                <th scope="col">Día</th>
                                <th scope="col">Hora</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                            @if($consultas->count())
                            @foreach($consultas as $consulta)
                                <tr>
                                <td>{{ $consulta->id }}</th>
                                <td>{{ $consulta->materia->descripcion }}</td>
                                <td>{{ $consulta->profesor->getNombreCompleto() }}</td>
                                <td>{{ getNumeroDia($consulta->numero_dia) }}</td>
                                <td>{{ $consulta->hora }}</td>

                                <td><a class="btn btn-primary btn-xs" href="{{action('ConsultaController@edit', $consulta->id)}}" ><span class="fa fa-pen"></span></a></td>
                                <td>
                                <form action="{{action('ConsultaController@destroy', $consulta->id)}}" method="post">
                                        <form action="{{action('ConsultaController@destroy', $consulta->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay consultas registradas.</td>
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
</div>
@endsection
