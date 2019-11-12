<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Usuario;
use Auth;

class PerfilController extends Controller
{
  public function index() {
    $perfiles = Auth::user();
    if (Auth::user()->id == 2) {
      $perfiles = Auth::user();
      return view('pages.alumno.perfil.listado')->with(['perfiles' => $perfiles]);
      
    } else {
      $perfiles = Auth::user();
      return view('pages.profesor.perfil.listado')->with(['perfiles' => $perfiles]);
    }
  }
}
