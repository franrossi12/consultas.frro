@extends("layout.layout")

@section("content")
    <div class="container  row mt-4 mb-4 ml-1 ">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 offset-md-4 offset-lg-4 bg-light-gray card">
            <div class="col-12">
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
                    @if(isset($message))
                        <div class="row p-3">
                            <div class="col-12 alert alert-success">
                                {{ $message }}
                            </div>
                        </div>
                    @endif
                <form method="POST" action="{{ route('soporte.store') }}" role="form">
                    {{ csrf_field() }}
                    <h3 class=" p-2">Formulario de contacto con soporte</h3>
                    <div class="row">
                        <div class="col-12">
                            <label><b>Nombre:</b></label>
                            <input type="text" class="form-control"
                                   name="nombre" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label><b>Email Contacto:</b></label>
                            <input type="email" class="form-control"
                                   name="email" value="" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label><b>Asunto:</b></label>
                            <input type="text" class="form-control" name="asunto"
                                   value="" required id="asunto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            <label><b>Mensaje:</b></label>
                            <textarea name="mensaje" id="mensaje" style="width: 100%"
                                       rows="9" required>
                            </textarea>

                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-2">
                        <button class="btn btn-block btn-primary" type="submit" name="button">Enviar</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
