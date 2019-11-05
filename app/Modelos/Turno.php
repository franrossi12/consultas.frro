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
        'fecha_hora',
        'cantidad_alumnos'
    ];

    public function consulta() {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }

    public function consultaAlternativa() {
        return $this->belongsTo(ConsultaAlternativa::class, 'consulta_alternativa_id');
    }
    protected $dates = [
        'created_at',
        'fecha_hora'
    ];
}
