<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\DiaSinClase;


class DiaSinClaseController extends Controller
{
        public function index()
        {
            $diasSinClase=diaSinClase::orderBy('id','DESC')->paginate(12);
            return view('pages.admin.diasSinClase.index',compact('diasSinClase')); 
        }
        public function create()
        {
            return view('pages.admin.diasSinClase.create');
        }
        public function store(Request $request)
        {
            $this->validate($request,[  'descripcion'=>'required',
                                        'fecha_desde'=>'required',       
                                        'fecha_hasta'=>'required']);
            DiaSinClase::create($request->all());

            return redirect()->route('diasSinClase.index')->with('success','Registro creado satisfactoriamente');
        }
        public function edit($id)
        {
            $diasSinClase=diaSinClase::find($id);
            return view('pages.admin.diasSinClase.edit',compact('diasSinClase'));
        }
        public function update(Request $request, $id)    
        {
            $this->validate($request,[  'descripcion'=>'required',
                                        'fecha_desde'=>'required',
                                        'fecha_hasta'=>'required']);
            diaSinClase::find($id)->update($request->all());

            return redirect()->route('diasSinClase.index')->with('success','Registro actualizado satisfactoriamente');
        }
        public function destroy($id)
        {
            diaSinClase::find($id)->delete();
            return redirect()->route('diasSinClase.index')->with('success','Registro eliminado satisfactoriamente');
        }
    }
