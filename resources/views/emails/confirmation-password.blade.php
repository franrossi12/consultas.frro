@extends("emails.layout")

@section("content")
    <tr>
            <td>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:30px;color:#333333;text-align:center;line-height:30px;letter-spacing:2px;padding:50px 0 20px 0">

                    ¡Hola, {{$usuario->nombre}}!
                </div>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:18px;color:#666666;text-align:center;line-height:24px;letter-spacing:2px;padding:5px 0 20px 0">

                    tu registro está casi completo...
                </div>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:16px;color:#666666;line-height:22px;padding:15px 10px 30px 10px">

                    Para completar el registro debes validar tu dirección de email
                    ingresando un código de activación:
                </div>
                <br>

                <div style="margin:0 auto;text-align:center;padding:25px 0 45px 0">
                    <a href={{ config('app.url') . '/confirmar-contraseña/' . $usuario->token_verificar }}
                        style="background-color:#39B4EB;border-top-width:0px;border-right-width:0px;border-bottom-width:4px;border-left-width:0px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:#39B4EB;border-right-color:#39B4EB;border-bottom-color:#39B4EA;border-left-color:#39B4EB;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;color:#ffffff;display:inline-block;font-family:Arial,Helvetica,sans-serif;font-size:16px;text-transform:uppercase;font-weight:normal;height:50px;line-height:55px;text-align:center;text-decoration:none;width:200px"
                       target="_blank">
                        <strong>
                            validar email
                        </strong>
                    </a>
                    <br>
                    <p>En caso de no visualizar el botón ingrese la siguiente url en su navegador:</p> <br>
                    <b>{{ config('app.url') . '/confirmar-contraseña/' . $usuario->token_verificar }}</b>
                </div>

        </td>
    </tr>

@endsection
