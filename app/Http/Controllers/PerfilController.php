<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Usuario;
use Auth;

class PerfilController extends Controller
{
  public function index() {
    $perfiles = Auth::user();
  /*  $user = Usuario::where('id','4')->first(); */
    return view('pages.alumno.perfil.listado')->with(['perfiles' => $perfiles]);
      }
}
