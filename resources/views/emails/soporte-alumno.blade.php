@extends("emails.layout")

@section("content")
    <tr>
            <td>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:30px;color:#333333;text-align:left;line-height:30px;letter-spacing:2px;padding:50px 0 20px 0">
                    Nuevo mensaje a soporte:
                </div>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:16px;color:#666666;line-height:22px;padding:15px 10px 30px 10px">
                    <b>Nombre de contacto:</b> {{ $nombre }}, <br>
                    <b>Email de contacto:</b> {{ $email }}, <br>
                    <b>Asunto:</b> {{ $asunto }}, <br>
                    <b>Mensaje:</b><br>
                    <p>{{ $mensaje }}</p>
                </div>
        </td>
    </tr>

@endsection
