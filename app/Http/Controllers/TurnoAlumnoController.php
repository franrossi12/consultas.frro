<?php

namespace App\Http\Controllers;

use App\Modelos\Turno;
use App\Modelos\TurnoAlumno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class TurnoAlumnoController extends Controller
{
    public function store(Request $request) {
        $response = [ 'error' => false, 'data' => null, 'msg' => '' ];
        DB::beginTransaction();
        try {
            $data = $request->toArray();
            //busco turno
            $alumno = Auth::user();
            $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);
            if ($data['consulta_alternativa']) {
                $turno = Turno::where('consulta_alternativa_id', $data['consulta_id'])
                    ->whereDate('fecha_hora', '=', $fecha->format('Y-m-d'))
                    ->first();
            } else {
                $turno = Turno::where('consulta_id', $data['consulta_id'])
                    ->whereDate('fecha_hora', '=', $fecha->format('Y-m-d'))
                    ->first();
            }

            // si no existe el turno lo creo
            if (empty($turno)) {
                $turno = new Turno();
                $turno->cantidad_alumnos = 0;
                if ($data['consulta_alternativa']) {
                    $turno->consulta_alternativa_id =  $data['consulta_id'];
                } else {
                    $turno->consulta_id =  $data['consulta_id'];
                }
                $turno->fecha_hora = $fecha->format('Y-m-d') . ' ' . $data['hora'];
                $turno->save();
            }
            $turno_alumno = TurnoAlumno::where('turno_id', $turno->id)
                ->where('alumno_id', '=', $alumno->id)
                ->first();
            // si no existe la relacion turno alumno la creo
            if (empty($turno_alumno)) {
                $turno_alumno = new TurnoAlumno();
                $turno_alumno->alumno_id = $alumno->id;
                $turno_alumno->turno_id = $turno->id;
                $turno_alumno->save();
            } else {
                throw new \Exception('Usted ya se encuentra inscripto en esa fecha y hora');
            }

            $turno->cantidad_alumnos += 1;
            $turno->save();
            $response['msg'] = "Inscripción exitosa";
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }


        return response()->json($response);

    }
}
