@extends("layout.layout")

@section('sidebar')
@include("layout.alumno.sidebar")
@endsection


@section("content")
    <div class="row">
        <div class="col-md-8 offset-md-1 col-sm-12 col-xs-12 mt-4">
            <div class="home-text" style="background-color: rgba(0,0,0,.7);">
                <h1>Mapa del sitio</h1>
                
                <h5>Paginas:</h5>
                <ul style="margin-left:15px;">
                    <li> <a href="{{ homeRoute() }}">Inicio</a> </li>
                    <li style="margin-left:10px;">
                        <a href="{{ route('alumno.perfil') }}">Perfil</a>
                    </li>
                    <li style="margin-left:10px;">    
                        <a href="{{ route('alumno.consultas.inscripcion') }}">Inscripción a Consulta</a>
                    </li>
                    <li style="margin-left:10px;">    
                        <a href="{{ route('alumno.consultas.listado') }}">Listado de Consultas</a>
                    </li>
                </ul>           
            </div>
        </div>
    </div>
@endsection
