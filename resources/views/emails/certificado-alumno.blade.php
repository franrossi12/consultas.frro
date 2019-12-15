<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificado de Examen</title>
</head>
<body>

<main style="width: 100%; position: relative; margin: 0 auto;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#343a40">
        <tr>
            <td style="padding: 10px;font-size:0pt; line-height:0pt; text-align:left;">
                <a href="https://www.frro.utn.edu.ar/" target="_blank">
                    <img src="{{ asset('img/logoutnwhite.png') }}"  height="50" border="0" alt="" />
                </a>
            </td>
            <td class="" style="text-align:left; color: white;">
                <h4>Consultas FRRO</h4>
            </td>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr style="background-color: lightslategrey; color: white; border-color: black">
            <td  colspan="2"  style="padding: 20px; text-align: center">Certificado de Inscripción</td>
        </tr>
        <tr style="padding: 15px; text-align: center" >
            <td style="padding: 15px; text-align: center; width: 30%" ><b>Materia:</b></td>
            <td>{{ $turno_a->turno->consulta->materia->descripcion }}</td>
        </tr>
        <tr style="padding: 10px 30px 10px 50px; color:#000000; text-align:center;">
            <td style="padding: 15px; text-align: center; width: 30%" ><b>Profesor:</b></td>
            <td>{{ $turno_a->turno->consulta->profesor->getNombreCompleto() }}</td>
        </tr>
        <tr style="padding: 10px 30px 10px 50px; color:#000000; text-align:center;">
            <td style="padding: 15px; text-align: center; width: 30%" ><b>Alumno:</b></td>
            <td>{{ $turno_a->alumno->getNombreCompleto() }}</td>
        </tr>
        <tr style="padding: 10px 30px 10px 50px; color:#000000; text-align:center;">
            <td style="padding: 15px; text-align: center; width: 30%" ><b>Fecha y Hora de Consulta:</b></td>
            <td>{{ $turno_a->turno->fecha_hora->format('d/m/Y H:i') }}</td>
        </tr>
        <tr style="padding: 10px 30px 10px 50px; color:#000000; text-align:center;">
            <td style="padding: 15px; text-align: center; width: 30%" ><b>Fecha y Hora de Inscripción:</b></td>
            <td>{{ $turno_a->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>
</main>
</body>
</html>
