<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Consulta;


class ConsultaController extends Controller
{
  public function index()
  {
      $consultas=consulta::orderBy('id','DESC')->paginate(12);
      return view('pages.admin.consultas.index',compact('consultas')); 
  }
  public function create()
  {
      return view('pages.admin.consultas.create');
  }
  public function store(Request $request)
  {
      $this->validate($request,[  'descripcion'=>'required',
                                  'carrera_id'=>'required']);
                                  consulta::create($request->all());

      return redirect()->route('consultas.index')->with('success','Registro creado satisfactoriamente');
  }
  public function edit($id)
  {
      $consultas=consulta::find($id);
      return view('pages.admin.consultas.edit',compact('consultas'));
  }
  public function update(Request $request, $id)    
  {
      $this->validate($request,[  'materia_id'=>'required',
                                  'profesor_id'=>'required',
                                  'numero_dia'=>'required',
                                  'hora'=>'required']);
      consulta::find($id)->update($request->all());

      return redirect()->route('consultas.index')->with('success','Registro actualizado satisfactoriamente');
  }
  public function destroy($id)
  {
      Materia::find($id)->delete();
      return redirect()->route('consultas.index')->with('success','Registro eliminado satisfactoriamente');
  }
}
