<?php

namespace App\Http\Controllers;

use App\Modelos\Carrera;
use App\Modelos\Consulta;
use App\Modelos\Materia;
use App\Modelos\Usuario;
use App\Modelos\Dia;
use Illuminate\Http\Request;



class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::orderBy('id', 'DESC')->paginate(12);
        return view('pages.admin.consultas.index', compact('consultas'));
    }

    public function create()
    {
        $dias= Dia::all();
        $materias = Materia::all();
        $profesores = Usuario::where('perfil_id','3')->get();

        return view('pages.admin.consultas.create')
            ->with(compact('materias', 'profesores', 'dias'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['materia_id' => 'required',
            'profesor_id' => 'required',
            'numero_dia' => 'required',
            'hora' => 'required']);
        Consulta::create($request->all());

        return redirect()->route('consultas.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[  'materia_id' => 'required',
                                    'profesor_id' => 'required',
                                    'numero_dia' => 'required',
                                    'hora' => 'required']);
        Consulta::find($id)->update($request->all());


        return redirect()->route('consultas.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    public function index_materia()
    {
        $materias = Materia::paginate(1);
        return view('pages.admin.materias.listado')->with(['materias' => $materias]);
    }

    public function destroy($id)
    {
        Materia::find($id)->delete();
        return redirect()->route('consultas.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    public function edit($id){
        $consulta= Consulta::find($id);
        $dias= Dia::all();
        $materias = Materia::all();
        $profesores = Usuario::where('perfil_id','3')->get();

        return view('pages.admin.consultas.edit')->with([
            'consulta' => $consulta,
            'dias' => $dias,
            'materias' => $materias,
            'profesores' => $profesores
        ]);
    }

    public function inscripcionForm()
    {
        $materias = Materia::all();
        $profesores = Usuario::where('perfil_id','3')->get();
        return view('pages.alumno.consultas.inscripcion.form')->with(['materias' => $materias,'profesores' => $profesores]);
    }

    public function index_profesor()
    {
        $profesores = Usuario::paginate(1);
        return view('pages.admin.profesores.listado')->with(['usuarios' => $profesores]);
    }

    public function buscarConsultas(Request $request)
    {
        $filtros = $request->toArray();
        $query = Consulta::select('consultas.*', 'usuarios.nombre as profesor_nombre',
            'usuarios.apellido as profesor_apellido',
            'materias.descripcion as materia')
            ->join('usuarios', 'usuarios.id', '=', 'consultas.profesor_id')
            ->join('materias', 'materias.id', '=', 'consultas.materia_id');

        // todo falta agregar que merge con consultas alternativas

        if ($filtros['materia'] != '' && !empty($filtros['materia'])) {
            $query = $query->where('materias.id', $filtros['materia']);
        }
        if ($filtros['profesor'] != '' && !empty($filtros['profesor'])) {
            $query->where('usuarios.id', $filtros['profesor']);
        }
        $consultas = $query->get();
        return response()->json($consultas);
    }
}
