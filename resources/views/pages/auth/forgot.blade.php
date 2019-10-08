@extends("layout.layout")

@section("content")
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Reiniciar Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.reset-submit') }}">
                        @csrf
                        @if(!empty($usuario))
                            <input type="hidden" name="email" id="email" value="{{$usuario->email}}">

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password"
                                           class="col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password_confirmation"
                                           class="col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password_confirmation" type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" required>

                                    @if($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <form method="POST" action="{{ route('auth.forgot-submit') }}">
                                @csrf

                                <div class="form-group row">

                                    <div class="col-md-12">
                               |         <label for="email" class=" col-form-label">{{ __('E-Mail') }}</label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <b>{{$errors->first()}}</b>
                                    </div>
                                @endif

                                <div class="form-group row mb-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Enviar datos') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
@endsection
