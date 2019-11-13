<?php

namespace App\Http\Controllers;

use App\Mail\CancelacionAlumnoEmail;
use App\Modelos\Consulta;
use App\Modelos\Turno;
use App\Modelos\TurnoCancelado;
use App\Modelos\Usuario;
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
        $this->validate($request, ['perfil_id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'password' => 'required']);
        Usuario::create($request->all());

        return redirect()->route('profesores.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function edit($id)
    {
        $profesores = usuario::find($id);
        return view('pages.admin.profesores.edit', compact('profesores'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required']);
        $usuario = Auth::user();
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->email = $request->get('email');
        $usuario->save();

        return redirect()->route('profesor.perfil')
            ->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        Usuario::find($id)->delete();
        return redirect()->route('profesores.index')->with('success', 'Registro eliminado satisfactoriamente');
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
}
