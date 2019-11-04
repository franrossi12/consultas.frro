<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TurnoCancelado extends Model
{
    protected $table = "turnos_cancelados";

    protected $fillable = [
        'id',
        'consulta_id',
        'fecha',
        'hora',
        'motivo'
    ];

    public function consulta() {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
}
