@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")
<div class="container" id="container">

<div class="row mt-3">
        <div class="col-md-12">
            <div class="panel panel-rigth">
                <div class="panel-body">
                    <div class="pull-left"><h3>Lista de Consultas</h3></div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped text-center">
                            <thead>
                                <th scope="col">Estado</th>
                                <th scope="col">Materia</th>
                                <th scope="col">Profesor</th>
                                <th scope="col">Fecha Consulta</th>
                                <th scope="col">Hora Consulta</th>
                                <th scope="col">Fecha Inscripción</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            @if($consultas->count())
                            @foreach($consultas as $consulta)
                                <tr>
                                    <td>{{ $consulta->estado() }}</td>
                                    <td>{{ $consulta->turno->consulta->materia->descripcion }}</th>
                                    <td>{{ $consulta->turno->consulta->profesor->getNombreCompleto() }}</td>
                                    <td>{{ $consulta->turno->fecha_hora->format('d/m/Y') }}</th>
                                    <td>{{ $consulta->turno->fecha_hora->format('H:i')  }}</th>
                                    <td>{{ $consulta->created_at->format('d/m/Y') }}</td>

                                    <td>
                                        @if($consulta->puedeCancelar())
                                        <button class="btn btn-danger btn-xs"
                                                type="submit" v-on:click="cancelarConfirmar({{$consulta->id}})">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                         @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No hay consultas registradas.</td>
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
@endsection

@section("beforeEndBody")

<!-- Our View App goes at the end of the document -->
<script>
  new Vue({
    el: "#container",
    data: {
      urlCancelar: '{{url('alumno/cancelar-consultas')}}',
    },
    methods:{
      cancelarConfirmar(id) {
        Swal.fire({
          title: 'Cancelar inscripcion!',
          text: 'Usted desea cancelar la consulta, confirmar?',
          icon: 'question',
          confirmButtonText: 'Sí',
          cancelButtonText: 'No',
          showCancelButton: true
        }).then((result) => {
          if (result.value) {
            this.incripcion(id);
          }
          $('.toast').toast()
        })
      },
      incripcion(id) {
        const data = {
          turno_alumno_id: id
        };
        axios
          .post(`${this.urlCancelar}`, data)
          .then(response => {
              this.response = response.data;
              if (response.data.error) {
                toastr.error(this.response.msg, 'Error al tratar de cancelar', {timeOut: 5000})
              } else {
                toastr.success(this.response.msg, 'Cancelación exitosa' , {timeOut: 5000})
                location.reload();
              }
            },
            (error) => {
              toastr.error(this.response.msg, 'Error en el servidor.', {timeOut: 5000})
            })
      },
    }
  })
</script>
<style>
</style>

@endsection
