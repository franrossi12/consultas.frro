@extends("layout.layout")

@section('sidebar')
    @include("layout.admin.sidebar")
@endsection


@section('content')
<div class="row mt-2">
{{--	<section class="content">--}}
		<div class="col-md-8 col-md-offset-2">
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
					<h3 class="panel-title">Nuevo dia sin clase</h3>
				</div>
				<div class="panel-body">
					<div class="table-container">
						<form method="POST" action="{{ route('diasSinClase.store') }}"  role="form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="descripcion" id="descripcion" class="form-control input-sm" placeholder="motivo " required>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="date" name="fecha_desde" id="fecha_desde" class="form-control input-sm" placeholder="fecha desde " required>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control input-sm" placeholder="fecha hasta ">
									</div>
								</div>
                            </div>

							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Guardar" class="btn btn-success btn-block">
									<a href="{{ route('diasSinClase.index') }}" class="btn btn-info btn-block" >Atrás</a>
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
