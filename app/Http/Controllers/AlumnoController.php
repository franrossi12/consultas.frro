<?php

namespace App\Http\Controllers;

use App\Modelos\TurnoAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                        ->join('turnos', 'turnos.id', '=', 'turnos_alumnos.turno_id')
                        ->orderBy('turnos.fecha_hora', 'desc')
                        ->paginate(15);
        return view('pages.alumno.consultas.listado')
                    ->with(['consultas'    => $consultas ]);
    }

    public function cancelarConsulta(Request $request) {
        $response = [ 'error' => false, 'data' => null, 'msg' => '' ];
        $turno_alumno_id = $request->get('turno_alumno_id');
        DB::beginTransaction();
        try {
            $turno_alumno = TurnoAlumno::where('id', $turno_alumno_id)->first();
            $turno_alumno->cancelado = 1;
            $turno_alumno->turno->cantidad_alumnos -= 1;
            $turno_alumno->turno->save();
            $turno_alumno->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }
    public function actualizarPerfil(Request $request)
    {
        $this->validate($request, ['nombre'     => 'required',
                                    'apellido'  => 'required',
                                    'email'     => 'required']);
        $usuario = Auth::user();
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->email = $request->get('email');
        $usuario->save();

        return redirect()->route('alumno.perfil')
                        ->with('success', 'Perfil actualizado correctamente.');
    }

}
