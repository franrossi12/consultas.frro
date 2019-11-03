<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Usuario;

class ProfesorController extends Controller
{
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
