<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TurnoCancelado extends Model
{
    protected $table = "turnos_cancelados";

    protected $fillable = [
        'id',
        'consulta_id',
        'consulta_alternativa_id',
        'fecha_hora',
        'motivo'
    ];

    public function consulta() {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
    protected $dates = [
        'created_at',
        'fecha_hora'
    ];
}
