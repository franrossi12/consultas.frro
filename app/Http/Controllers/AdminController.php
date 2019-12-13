<?php

namespace App\Http\Controllers;

use App\Modelos\Consulta;
use App\Modelos\Materia;
use App\Modelos\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function soporteStore(Request $datos) {
        $datos = $datos->all();
        Mail::send('emails.soporte-alumno', $datos, function ($message) {
            $message->from('consultasfrro@gmail.com', 'Consultas Frro');
            $message->to('consultasfrro@gmail.com')
                ->subject('Ticket de Soporte');
        });
        return view('pages.admin.soporte')
            ->with(['message'=>'Se ha enviado su mensaje a soporte.']);


    }
}
