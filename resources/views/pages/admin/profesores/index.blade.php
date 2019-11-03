@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection
    
@section("content")
<div class="container">


<div class="row">
    <section class="content">
        <div class="col-md-12">
            <div class="panel panel-rigth">
                <div class="panel-body">
                    <div class="pull-left"><h3>Lista de Profesores</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('profesores.create') }}" class="btn btn-info" width="100%" >Añadir Profesor</a>
                            </div>
                        </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">motivo</th>
                                <th scope="col">fecha_desde</th>
                                <th scope="col">fecha_hasta</th>
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
                                <td><a class="btn btn-primary btn-xs" href="{{action('ProfesorController@edit', $profesor->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                                <td>
                                <form action="{{action('ProfesorController@destroy', $profesor->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                                </tr>
                            @endforeach 
                            @else
                                <tr>
                                    <td colspan="8">No hay registro !!</td>
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
