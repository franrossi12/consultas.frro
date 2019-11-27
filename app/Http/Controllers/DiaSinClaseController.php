<?php

namespace App\Http\Controllers;

use App\Modelos\DiaSinClase;
use Illuminate\Http\Request;


class DiaSinClaseController extends Controller
{
    protected $messages = [
        'descripcion.required' => 'El campo descripcion es requerido.',
        'fecha_desde.required' => 'El campo Fecha Desde es requerido.'
    ];

    public function index()
    {
        $diasSinClase = diaSinClase::orderBy('id', 'DESC')->paginate(12);
        return view('pages.admin.diasSinClase.index', compact('diasSinClase'));
    }

    public function create()
    {
        return view('pages.admin.diasSinClase.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['descripcion' => 'required',
            'fecha_desde' => 'required'], $this->messages);
        DiaSinClase::create($request->all());

        return redirect()->route('diasSinClase.index')->with('success', 'Registro creado satisfactoriamente');
    }

    public function edit($id)
    {
        $diasSinClase = diaSinClase::find($id);
        return view('pages.admin.diasSinClase.edit', compact('diasSinClase'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['descripcion' => 'required',
            'fecha_desde' => 'required'
        ], $this->messages);
        diaSinClase::find($id)->update($request->all());

        return redirect()->route('diasSinClase.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        diaSinClase::find($id)->delete();
        return redirect()->route('diasSinClase.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
