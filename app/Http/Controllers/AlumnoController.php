<?php

namespace App\Http\Controllers;

use App\Modelos\TurnoAlumno;
use App\Modelos\TurnoCancelado;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    public function home() {
        $alumno = Auth::user();
        $consultas = TurnoAlumno::where('alumno_id',$alumno->id)
            ->select('fecha_hora', 'cancelado')
            ->join('turnos', 'turnos.id', '=', 'turnos_alumnos.turno_id')
            ->get();

        $consultas_canceladas = $consultas->where('cancelado', '=', 1);
        $futuras = $consultas->where('fecha_hora', '>=', date('Y-m-d H:i:s'))->where('cancelado', '=', 0);
        $pasadas = $consultas->where('fecha_hora', '<', date('Y-m-d H:i:s'))->where('cancelado', '=', 0);

        return view('pages.alumno.home')
                ->with(['canceladas'    => count($consultas_canceladas),
                        'futuras'       => count($futuras),
                        'pasadas'       => count($pasadas)]);
    }

    public function listadoConsultas() {
        $alumno = Auth::user();
        $consultas = TurnoAlumno::where('alumno_id',$alumno->id)
                        ->paginate(15);
        return view('pages.alumno.consultas.listado')
                    ->with(['consultas'    => $consultas ]);
    }

}
