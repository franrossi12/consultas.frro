@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection


@section('content')
<div class="row">
{{--	<section class="content">--}}
		<div class="col-md-12 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
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
					<h3 class="panel-title">Editar Consulta</h3>
				</div>
				<div class="panel-body">
					<div class="table-container">
						<form method="POST" id="form" action="{{ route('consultas.update',$consulta->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
							<div class="row">
                                <div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
                                    <v-select name="materia" id="materia"
                                              v-model="materia"
                                              class="style-chooser"
                                              :options="materias"
                                              :reduce="p => p.id"
                                              label="descripcion"
                                              placeholder="Seleccione Materia">
                                        <div slot="no-options">No hay opciones aquí</div>
                                    </v-select>
                                </div>
								<div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
								  	<v-select name="profesor" id="profesor"
									  	value="{{$consulta->profesor_id}}"
									 	v-model="profesor"
								  		class="style-chooser"
										:options="profesores"
										:reduce="p => p.id"
										label="apellido"
										placeholder="Seleccione Profesor">
										<div slot="no-options">No hay opciones aquí</div>
									</v-select>
								</div>
								<div class="col-md-6 col-lg-6 col-12 col-sm-12 mb-2">
									<v-select name="dia" id="numero_dia"
										value="{{$consulta->numero_dia}}"
										v-model="dia"
										class="style-chooser"
										:options="dias"
										:reduce="d => d.id"
										label="descripcion"
										placeholder="Seleccione un dia">
										<div slot="no-options">No hay opciones aquí</div>
									 </v-select>

								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="time" name="hora" id="hora" class="form-control input-sm"  step="2"
                                               value="{{$consulta->hora}}">
									</div>
								</div>
							</div>
                            <input type="hidden" name="materia_id" :value="this.materia">
                            <input type="hidden" name="profesor_id" :value="this.profesor">
                            <input type="hidden" name="numero_dia" :value="this.dia">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
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

    <!-- Our View App goes at the end of the document -->
    <script>
      new Vue({
        el: "#form",
        components: {
          'v-select': VueSelect.VueSelect
        },
        data: {
			dias: @json($dias),
          	dia: {{$consulta->numero_dia}},
          	materias: @json($materias),
          	materia: {{$consulta->materia_id}},
          	profesores: @json($profesores),
          	profesor: {{$consulta->profesor_id}},
        },
		methods: {
		}
       })
    </script>

@endsection
