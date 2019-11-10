<?php

namespace App\Http\Controllers;

use App\Modelos\Consulta;
use App\Modelos\Materia;
use App\Modelos\Usuario;

class AdminController extends Controller
{
    public function home() {
        $profesores = count(Usuario::where('perfil_id','3')->get());
        $materias = count(Materia::all());
        $consultas = count(Consulta::all());

        return view('pages.admin.home')
                ->with(['profesores'    => $profesores,
                        'materias'      => $materias,
                        'consultas'     => $consultas]);
    }
}
