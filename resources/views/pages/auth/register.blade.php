@extends("layout.layout")

@section("content")
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.register-submit') }}">
                            @csrf


                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre') }}</label>
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                    @if($errors->has('nombre'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="apellido" class="col-form-label text-md-right">{{ __('Apellido') }}</label>
                                    <input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required >

                                    @if($errors->has('apellido'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" name="password" required>

                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password_confirmation" class="col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                    @if($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            @if(isset($message))
                            <div class="row">
                                <div class="col-12 alert alert-success">
                                    {{ $message }}
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-4">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Registrarse') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
