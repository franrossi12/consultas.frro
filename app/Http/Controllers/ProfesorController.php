<?php

namespace App\Http\Controllers;

use App\Mail\CancelacionAlumnoEmail;
use App\Modelos\Consulta;
use App\Modelos\ConsultaAlternativa;
use App\Modelos\Perfil;
use App\Modelos\Turno;
use App\Modelos\TurnoCancelado;
use App\Modelos\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProfesorController extends Controller
{
    public function home()
    {
        $profesor = Auth::user();
        $consultas = Turno::select('fecha_hora', 'profesor_id', 'cancelado')
            ->join('consultas', 'consultas.id', '=', 'turnos.consulta_id')
            ->where('consultas.profesor_id', $profesor->id)
            ->get();

        $consultas_c = TurnoCancelado::select('fecha_hora', 'profesor_id')
            ->join('consultas', 'consultas.id', '=', 'turnos_cancelados.consulta_id')
            ->where('consultas.profesor_id', $profesor->id)
            ->get();

        $turnos_c = $consultas->where('cancelado', '=', 1);

        $futuras = $consultas->where('fecha_hora', '>=', date('Y-m-d H:i:s'))->where('cancelado', '=', 0);
        $pasadas = $consultas->where('fecha_hora', '<', date('Y-m-d H:i:s'))->where('cancelado', '=', 0);

        return view('pages.profesor.home')
            ->with(['canceladas' => (count($consultas_c) + count($turnos_c)),
                'futuras' => count($futuras),
                'pasadas' => count($pasadas)]);
    }

    public function listadoConsultas()
    {
        $profesor = Auth::user();
        $consultas = Turno::join('consultas', 'consultas.id', '=', 'turnos.consulta_id')
            ->select('turnos.*')
            ->where('consultas.profesor_id', $profesor->id)
            ->orderBy('fecha_hora', 'desc')
            ->paginate(15);

        return view('pages.profesor.consultas.listado')
            ->with(['consultas' => $consultas]);
    }

    public function index()
    {
        $profesores = Usuario::where('perfil_id', '3')->paginate(12);
        return view('pages.admin.profesores.index', compact('profesores'));
    }

    public function create()
    {
        return view('pages.admin.profesores.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'password' => 'required']);
        $data = $request->all();
        $perfil_id = Perfil::where('tag', 'PROFESOR')->pluck('id')->first();
        $data['perfil_id'] =$perfil_id;
        Usuario::create($data);

        return redirect()->route('profesores.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function edit($id)
    {
        $profesores = usuario::find($id);
        return view('pages.admin.profesores.edit', compact('profesores'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required']);
        $usuario = Usuario::where('id', $id)->first();
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->email = $request->get('email');
        $usuario->save();

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor actualizado satisfactoriamente');

    }

    public function destroy($id)
    {
        $consulta = Consulta::where('profesor_id', $id)->first();
        if (empty($consulta)) {
            Usuario::find($id)->delete();
            return redirect()->route('profesores.index')
                ->with('success', 'Registro eliminado satisfactoriamente');
        } else {
            return redirect()->route('profesores.index')
                ->with('error', 'No se ha podido eliminar el profesor, posee consultas asociadas.');
        }
    }

    public function cancelarConsulta(Request $request) {
        $response = [ 'error' => false, 'data' => null, 'msg' => '' ];
        $turno_id = $request->get('turno_id');
        DB::beginTransaction();
        try {
            $turno = Turno::where('id', $turno_id)->first();
            $turno->cancelado = 1;
            $alumnos_email = [];
            foreach ($turno->turnosAlumno as &$turno_alumno) {
                $alumnos_email[] = $turno_alumno->alumno->email;
                $turno_alumno->cancelado = 1;
                $turno_alumno->save();
            }
            $turno->save();
            // envio mail a alumnos, pasar a job y cron
            Mail::to($alumnos_email)->send(new CancelacionAlumnoEmail($turno));
            DB::commit();
            $response['msg'] = 'Turno cancelado con éxito. Los alumnos fueron notificados.';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }
    public function consultaCancelarIndex()
    {
        $profesor = Auth::user();
        $desc_selec = "CONCAT(materias.descripcion, ' - ', dias.descripcion, ' a las ', TIME_FORMAT(consultas.hora, '%H:%ihs')) as descripcion";
        $consultas = Consulta::select('consultas.id as id',
            DB::raw($desc_selec), 'consultas.numero_dia as numero_dia')
        ->where('profesor_id', $profesor->id)
            ->join('materias', 'materias.id', '=', 'consultas.materia_id')
            ->join('dias', 'dias.numero', '=', 'consultas.numero_dia')

            ->get();

        return view('pages.profesor.consultas.cancelar')
            ->with(['consultas' => $consultas]);
    }
    public function cancelarConsultaFuturas(Request $request)
    {
        $response = [ 'error' => false, 'data' => null, 'msg' => '' ];
        $data = $request->all();
        // formateo de fechas
        $fecha_cancelar = Carbon::createFromFormat('d/m/Y', $data['fecha']);
        $fecha_nueva = Carbon::createFromFormat('d/m/Y', $data['fecha_nueva']);
        $fecha_y_hora = $fecha_nueva->format('Y-m-d') . ' ' . $data['hora_nueva'] . ':00';
        $consulta = Consulta::where('id', $data['consulta_id'])->first();
        $fecha_y_hora_can = $fecha_cancelar->format('Y-m-d') . ' ' . $consulta->hora;
        // primero busco un turno si es que ya hay
        DB::beginTransaction();
        try {
            $turno = Turno::where('consulta_id', $data['consulta_id'])
                ->whereDate('fecha_hora', '=', $fecha_cancelar->format('Y-m-d'))
                ->where('cancelado', 0)
                ->first();
            if (empty($turno)) {
                // creo consulta alternativa
                $alt = new ConsultaAlternativa();
                $alt->materia_id = $consulta->materia_id;
                $alt->profesor_id = $consulta->profesor_id;
                $alt->fecha_hora = $fecha_y_hora;
                $alt->save();
                // guardo la cancelacion del turno
                $a = new TurnoCancelado();
                $a->consulta_id =  $consulta->id;
                $a->fecha_hora = $fecha_y_hora_can;
                $a->motivo = $data['motivo'];
                $a->consulta_alternativa_id = $alt->id;
                DB::commit();
                $response['msg'] = "Cancelacion de turno exitosa";
            } else {
                throw new \Exception('Existen alumnos inscriptos en turno a cancelar.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);


    }
}
