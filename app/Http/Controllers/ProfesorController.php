<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Usuario;

class ProfesorController extends Controller
{
    public function index() {
      $profesores = Usuario::where('perfil_id','3')->paginate(1);
      return view('pages.admin.profesores.listado')->with(['profesores' => $profesores]);
            }

}
