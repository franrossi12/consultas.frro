<?php

namespace App\Http\Controllers;

use App\Modelos\Carrera;
use App\Modelos\Consulta;
use App\Modelos\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    protected $messages = [
        'descripcion.required' => 'El campo :attribute es requerido.',
        'carrera_id.required' => "La carrera es requerida"
    ];
    public function index()
    {
        $materias = Materia::orderBy('id', 'DESC')->paginate(12);
        return view('pages.admin.materias.index', compact('materias'));
    }

    public function create()
    {
        $carreras = Carrera::all();
        return view('pages.admin.materias.create', compact('carreras'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['descripcion' => 'required',
            'carrera_id' => 'required'], $this->messages);
        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function edit($id)
    {
        $carreras = Carrera::all();
        $materias = materia::find($id);
        return view('pages.admin.materias.edit', compact('materias', 'carreras'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['descripcion' => 'required',
            'carrera_id' => 'required'], $this->messages);
        Materia::find($id)->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        $consulta = Consulta::where('materia_id', $id)->first();
        if (empty($consulta)) {
            Materia::find($id)->delete();
            return redirect()->route('materias.index')
                ->with('success', 'Registro eliminado satisfactoriamente');
        } else {
            return redirect()->route('materias.index')
                ->with('error', 'No se ha podido eliminar la materia, posee consultas asociadas.');
        }
    }

    public function getByCarrera($id_carrera)
    {
        $materias = Materia::where('carrera_id', $id_carrera)->get();
        return response()->json($materias);
    }
}
