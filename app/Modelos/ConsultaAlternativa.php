<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ConsultaAlternativa extends Model
{
    protected $table = "consultas_alternativas";

    protected $fillable = [
        'id',
        'materia_id',
        'profesor_id',
        'fecha_hora'
    ];
}
