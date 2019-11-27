@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
    <div class="container  row m-2 ">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 bg-light-gray card">
            <div class="col-12 mt-2">
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
                <form method="POST" action="{{ route('alumno.perfil.actualizar') }}" role="form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            <label><b>Nombre:</b></label>
                            <input type="text" class="form-control"
                                   name="nombre" value="{{ $perfiles->nombre }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label><b>Apellido:</b></label>
                            <input type="text" class="form-control"
                                   name="apellido" value="{{ $perfiles->apellido }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <label><b>Email:</b></label>
                            <input type="text" class="form-control" name="email"
                                   value="{{ $perfiles->email }}" required>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-2">
                        <button class="btn btn-block btn-primary" type="submit" name="button">Actualizar perfil</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
