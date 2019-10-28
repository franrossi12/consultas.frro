<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Consulta;
use App\Modelos\Dia;
use App\Modelos\Materia;
use App\Modelos\Usuario;

class ConsultaController extends Controller
{
    public function index() {
      $consultas = Consulta::paginate(1);
      $dias = Dia::all();
      return view('pages.admin.consultas.listado')->with(['consultas' => $consultas, 'dias' => $dias]);
    }


}
