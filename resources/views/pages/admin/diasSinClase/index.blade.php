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
                    <div class="pull-left"><h3>Lista de dias sin clase</h3></div>
                        <div class="text center">
                            <div class="btn-group">
                                <a href="{{ route('diasSinClase.create') }}" class="btn btn-info" width="100%" >Añadir dia</a>
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
                            @if($diasSinClase->count())
                            @foreach($diasSinClase as $diasc)
                                <tr>
                                <td>{{ $diasc->id }}</th>
                                <td>{{ $diasc->descripcion }}</td>
                                <td>{{ $diasc->fecha_desde }}</td>
                                <td>{{ $diasc->fecha_hasta }}</td>
                                <td><a class="btn btn-primary btn-xs" href="{{action('DiaSinClaseController@edit', $diasc->id)}}" ><span class="fa fa-pen"></span></a></td>
                                <td>
                                <form action="{{action('DiaSinClaseController@destroy', $diasc->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                </form>
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
                {{ $diasSinClase->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
