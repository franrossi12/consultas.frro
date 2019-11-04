<?php

namespace App\Http\Controllers;

use App\Modelos\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::orderBy('id', 'DESC')->paginate(12);
        return view('pages.admin.materias.index', compact('materias'));
    }

    public function create()
    {
        return view('pages.admin.materias.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['descripcion' => 'required',
            'carrera_id' => 'required']);
        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function edit($id)
    {
        $materias = materia::find($id);
        return view('pages.admin.materias.edit', compact('materias'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['descripcion' => 'required',
            'carrera_id' => 'required']);
        Materia::find($id)->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        Materia::find($id)->delete();
        return redirect()->route('materias.index')->with('success', 'Registro eliminado satisfactoriamente');
    }

    public function getByCarrera($id_carrera)
    {
        $materias = Materia::where('carrera_id', $id_carrera)->get();
        return response()->json($materias);
    }
}
