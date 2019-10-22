<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Consulta;
use App\Modelos\Dia;
use App\Modelos\Materia;

class ConsultaController extends Controller
{
    public function index() {
      $consultas = Consulta::paginate(1);
      $dias = Dia::all();
      return view('pages.admin.consultas.listado')->with(['consultas' => $consultas, 'dias' => $dias]);
    }

    public function index_materia() {
      $materias = Materia::paginate(1);
      //$dias = Dia::all();
      return view('pages.admin.materias.listado')->with(['materias' => $materias]);
        }

}