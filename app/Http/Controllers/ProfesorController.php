<?php

namespace App\Http\Controllers;

use App\Modelos\Turno;
use App\Modelos\TurnoCancelado;
use Illuminate\Http\Request;
use App\Modelos\Usuario;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function home() {
        $profesor = Auth::user();
        $consultas = Turno::select('fecha_hora', 'profesor_id')
            ->join('consultas', 'consultas.id', '=', 'turnos.consulta_id')
            ->where('consultas.profesor_id', $profesor->id)
            ->get();

        $consultas_c = TurnoCancelado::select('fecha_hora', 'profesor_id')
            ->join('consultas', 'consultas.id', '=', 'turnos_cancelados.consulta_id')
            ->where('consultas.profesor_id', $profesor->id)
            ->get();

        $futuras = $consultas->where('fecha_hora', '>=', date('Y-m-d H:i:s'));
        $pasadas = $consultas->where('fecha_hora', '<', date('Y-m-d H:i:s'));

        return view('pages.profesor.home')
            ->with(['canceladas'    => count($consultas_c),
                'futuras'       => count($futuras),
                'pasadas'       => count($pasadas)]);
    }
    public function listadoConsultas() {
        $profesor = Auth::user();
        $consultas = Turno::join('consultas', 'consultas.id', '=', 'turnos.consulta_id')
            ->where('consultas.profesor_id', $profesor->id)
            ->orderBy('fecha_hora', 'desc')
            ->paginate(15);

        return view('pages.profesor.consultas.listado')
            ->with(['consultas'    => $consultas ]);
    }
    public function index()
        {
            $profesores=Usuario::where('perfil_id','3')->paginate(12);
            return view('pages.admin.profesores.index',compact('profesores'));
        }
        public function create()
        {
            return view('pages.admin.profesores.create');
        }
        public function store(Request $request)
        {
            $this->validate($request,[  'perfil_id'=>'required',
                                        'nombre'=>'required',
                                        'apellido'=>'required',
                                        'email'=>'required',
                                        'password'=>'required']);
            Usuario::create($request->all());

            return redirect()->route('profesores.index')->with('success','Registro creado satisfactoriamente');
        }
        public function edit($id)
        {
            $profesores=usuario::find($id);
            return view('pages.admin.profesores.edit',compact('profesores'));
        }
        public function update(Request $request, $id)
        {
          $this->validate($request,[  'perfil_id'=>'required',
                                      'nombre'=>'required',
                                      'apellido'=>'required',
                                      'email'=>'required',
                                      'password'=>'required']);
          Usuario::find($id)->update($request->all());

            return redirect()->route('profesores.index')->with('success','Registro actualizado satisfactoriamente');
        }
        public function destroy($id)
        {
            Usuario::find($id)->delete();
            return redirect()->route('profesores.index')->with('success','Registro eliminado satisfactoriamente');
        }

}
