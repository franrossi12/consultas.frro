<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = "consultas";

    protected $fillable = [
        'id',
        'materia_id',
        'profesor_id',
        'numero_dia',
        'hora'
    ];
}
