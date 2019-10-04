<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TurnoCancelado extends Model
{
    protected $table = "turnos_cancelados";

    protected $fillable = [
        'id',
        'turno_id',
        'alumno_id',
        'hora',
        'notificado'
    ];
}
