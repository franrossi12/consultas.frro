@extends("layout.layout")

@section("content")
        <div class="row justify-content-center mt-3 mb-3">
            <div class="col-md-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Iniciar sesión') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.login-submit') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="email" class=" col-form-label">{{ __('E-Mail') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password" class="col-form-label">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(isset($message))
                                <div class="row p-3">
                                    <div class="col-12 alert alert-success">
                                        {{ $message }}
                                    </div>
                                </div>
                            @endif


                            @if($errors->any())
                                <div class="row p-3">
                                    <div class="col-12 alert alert-danger">
                                        <b>{{$errors->first()}}</b>
                                    </div>
                                </div>
                            @endif


                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Iniciar sesión') }}
                                    </button>
                                    <br>
                                    <a href="{{ route('auth.register') }}">
                                        <button type="button" class="btn btn-secondary btn-block">
                                        {{ __('Regístrate') }}
                                    </button></a>

                                    <a class="btn btn-link" href="{{ route('auth.forgot') }}">
                                        {{ __('Olvidaste tu Contraseña?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
