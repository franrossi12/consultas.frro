@extends("layout.layout")

@section("content")
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.reset-submit') }}">
                            @csrf
                            @if(!empty($usuario))
                                <input type="hidden" name="email" id="email" value="{{$usuario->email}}">
                            @endif
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                                    <input id="password_confirmation" type="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

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

                            @if($errors->any())
                                <div class="row">
                                    <div class="col-12 alert alert-danger">
                                        <b>{{$errors->first()}}</b>
                                    </div>
                                </div>
                            @endif


                            <div class="form-group row mb-4">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Resetear Contraseña') }}
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
