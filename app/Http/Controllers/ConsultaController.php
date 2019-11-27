<?php

namespace App\Http\Controllers;

use App\Modelos\Carrera;
use App\Modelos\Consulta;
use App\Modelos\ConsultaAlternativa;
use App\Modelos\Materia;
use App\Modelos\Turno;
use App\Modelos\Usuario;
use App\Modelos\Dia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ConsultaController extends Controller
{
    protected $messages = [
        'materia_id.required' => 'La materia es requerida.',
        'profesor_id.required' => 'El profesor es requerido.',
        'numero_dia.required' => 'El día es requerido.',
        'hora.required' => 'La hora es requerida.'
    ];
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
            'hora' => 'required'], $this->messages);
        Consulta::create($request->all());

        return redirect()->route('consultas.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[  'materia_id' => 'required',
                                    'profesor_id' => 'required',
                                    'numero_dia' => 'required',
                                    'hora' => 'required'], $this->messages);
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
        $turnos = Turno::where('consulta_id', $id)->get();
        if (count($turnos) <= 0) {
            Consulta::find($id)->delete();
            return redirect()->route('consultas.index')->with('success', 'Registro eliminado satisfactoriamente');
        } else {
            return redirect()->route('consultas.index')
                ->with('error', 'La consulta no se puede eliminar, posee turnos asociados');
        }
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



    public function index_profesor()
    {
        $profesores = Usuario::paginate(1);
        return view('pages.admin.profesores.listado')->with(['usuarios' => $profesores]);
    }

    public function buscarConsultas(Request $request)
    {
        $consultas = [];
        $filtros = $request->toArray();
        $query = Consulta::select('consultas.*', 'usuarios.nombre as profesor_nombre',
            'usuarios.apellido as profesor_apellido',
            'materias.descripcion as materia')
            ->join('usuarios', 'usuarios.id', '=', 'consultas.profesor_id')
            ->join('materias', 'materias.id', '=', 'consultas.materia_id');


        $query_al = ConsultaAlternativa::select('consultas_alternativas.materia_id',
            'consultas_alternativas.profesor_id','consultas_alternativas.id',
            DB::raw('DATE(fecha_hora) as fecha'),
            DB::raw('TIME(fecha_hora) as hora'),
            'usuarios.nombre as profesor_nombre',
            'usuarios.apellido as profesor_apellido',
            'materias.descripcion as materia')
            ->join('usuarios', 'usuarios.id', '=', 'consultas_alternativas.profesor_id')
            ->join('materias', 'materias.id', '=', 'consultas_alternativas.materia_id');


        if ($filtros['materia'] != '' && !empty($filtros['materia'])) {
            $query = $query->where('materias.id', $filtros['materia']);
            $query_al = $query_al->where('materias.id', $filtros['materia']);
        }
        if ($filtros['profesor'] != '' && !empty($filtros['profesor'])) {
            $query->where('usuarios.id', $filtros['profesor']);
            $query_al = $query_al->where('usuarios.id',$filtros['profesor']);
        }
        $consultas['consultas'] = $query->get();
        $consultas['alternativas'] = $query_al->get();
        return response()->json($consultas);
    }
}
