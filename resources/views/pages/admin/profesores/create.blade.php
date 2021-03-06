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
					<h3 class="panel-title">Nuevo Profesor</h3>
				</div>
				<div class="panel-body">
					<div class="table-container">
						<form method="POST" action="{{ route('profesores.store') }}"  role="form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input value="{{old('nombre', '')}}" type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="nombre " required>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input value="{{old('apellido', '')}}" type="text" name="apellido" id="apellido" class="form-control input-sm" placeholder="apellido" required>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input value="{{old('email', '')}}" type="email" name="email" id="email" class="form-control input-sm" placeholder="email" required>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input value="{{old('password', '')}}" type="password" name="password" id="password" class="form-control input-sm" placeholder="password" required>
									</div>
								</div>
                            </div>

							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Guardar" class="btn btn-success btn-block">
									<a href="{{ route('profesores.index') }}" class="btn btn-info btn-block" >Atrás</a>
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
