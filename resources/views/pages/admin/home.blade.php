@extends("layout.layout")

@section('sidebar')
@include("layout.admin.sidebar")
@endsection

@section("content")
    <div class="row m-3">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Cantidad de Profesores</h6>
                    <h3 class="text-right">
                        <i class="fa fa-calendar float-left"></i><span>{{$profesores}}</span>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Cantidad de Materias</h6>
                    <h3 class="text-right">
                        <i class="fa fa-archive float-left"></i><span>{{$materias}}</span>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Cantidad de Consultas</h6>
                    <h3 class="text-right">
                        <i class="fa fa-trash float-left"></i><span>{{$consultas}}</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endsection
