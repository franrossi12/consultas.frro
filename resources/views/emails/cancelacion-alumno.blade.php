@extends("emails.layout")

@section("content")
    <tr>
            <td>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:30px;color:#333333;text-align:left;line-height:30px;letter-spacing:2px;padding:50px 0 20px 0">
                    Hola,
                </div>
                <div style="font-family:Helvetica,arial,sans-serif;font-size:16px;color:#666666;line-height:22px;padding:15px 10px 30px 10px">
                    La consulta del día <b>{{ $turno->fecha_hora->format('d/m/Y') }}</b> a las
                    <b>{{ $turno->fecha_hora->format('H:i') }}</b> con el/la profesor/ar
                    <b>{{ $turno->consulta->profesor->getNombreCompleto() }}</b> ha sido cancelada.
                    <br>Ante cualquier duda comunicarse con el/la profesor/ar.
                </div>
        </td>
    </tr>

@endsection
