<?php

namespace App\Modelos;

use Carbon\Carbon;
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
    public function estado() {
        if ($this->fecha_hora >= date('Y-m-d H:i:s') ) {
            return 'Futuras';
        } else {
            return 'Pasadas';
        }
    }
    public function puedeCancelar() {
        return (($this->fecha_hora->diffInDays(Carbon::now()) >= 2) && ($this->estado() === 'Futuras'));
    }
    protected $dates = [
        'created_at',
        'fecha_hora'
    ];
}
