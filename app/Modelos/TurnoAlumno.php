<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TurnoAlumno extends Model
{
    protected $table = "turnos_alumnos";

    protected $fillable = [
        'id',
        'consulta_id',
        'fecha',
        'hora',
        'motivo'
    ];
}
