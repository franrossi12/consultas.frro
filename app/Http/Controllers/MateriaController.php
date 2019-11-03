<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Materia;

class MateriaController extends Controller
{
  public function index() {
    $materias = Materia::paginate(1);
    //$dias = Dia::all();
    return view('pages.admin.materias.listado')->with(['materias' => $materias]);
      }
}
