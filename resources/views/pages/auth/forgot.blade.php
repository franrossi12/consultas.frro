@extends("layout.layout")

@section("content")
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-6 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Reiniciar Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.forgot-submit') }}">
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

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <b>{{$errors->first()}}</b>
                            </div>
                        @endif


                        <div class="form-group row mb-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
