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
                    <div class="pull-left"><h3>Lista de Materias</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('materias.create') }}" class="btn btn-info" width="100%" >Añadir Materia</a>
                            </div>
                        </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">carrera</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                            @if($materias->count())  
                            @foreach($materias as $materia) 
                                <tr>
                                <td>{{ $materia->id }}</th>
                                <td>{{ $materia->descripcion }}</td>
                                <td>{{ $materia->carrera_id }}</td>

                                <td><a class="btn btn-primary btn-xs" href="{{action('MateriaController@edit', $materia->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                                <td>
                                <form action="{{action('MateriaController@destroy', $materia->id)}}" method="post">
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
                {{ $materias->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
