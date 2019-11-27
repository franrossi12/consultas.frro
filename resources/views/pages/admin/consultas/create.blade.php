@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection


@section('content')
    <div class="row mt-2">
        {{--	<section class="content">--}}
        <div class="col-md-12 col-md-offset-2">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> Revise los campos.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-info">
                    {{Session::get('success')}}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Crear Consulta</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <form method="POST" id="form" action="{{ route('consultas.store') }}"  role="form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                                    <select class="form-control" name="materia_id" id="materia_id" required>
                                        <option value="" selected hiden>Seleccione Materia</option>
                                        @foreach($materias as $materia)
                                            <option value="{{$materia->id}}" @if($materia->id === old('materia_id', '')) selected @endif>
                                                {{$materia->descripcion}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                                    <select class="form-control" name="profesor_id" id="profesor_id" required>
                                        <option value="" selected hiden>Seleccione Profesor</option>
                                        @foreach($profesores as $profesor)
                                            <option value="{{$profesor->id}}" @if($profesor->id === old('profesor_id', '')) selected @endif>
                                                {{$profesor->getNombreCompleto() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                                    <select class="form-control" name="numero_dia" id="numero_dia" required>
                                        <option value="" selected hiden>Seleccione Día</option>
                                        @foreach($dias as $dia)
                                            <option value="{{$dia->id}}" @if($dia->id === old('numero_dia', '')) selected @endif>
                                                {{$dia->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="time" name="hora" id="hora" class="form-control input-sm" required step="2"
                                        value="{{old('hora', '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Crear" class="btn btn-success btn-block">
                                    <a href="{{ route('consultas.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--	</section>--}}
    </div>

@endsection
@section("beforeEndBody")
@endsection
