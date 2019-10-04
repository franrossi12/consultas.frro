<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = "turnos";

    protected $fillable = [
        'id',
        'consulta_id',
        'consulta_alternativa_id',
        'fecha',
        'hora',
        'cantidad_alumnos'

    ];
}
