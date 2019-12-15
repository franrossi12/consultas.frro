<?php

namespace App\Modelos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TurnoAlumno extends Model
{
    protected $table = "turnos_alumnos";


    protected $fillable = [
        'id',
        'turno_id',
        'alumno_id',
        'hora',
        'notificado',
        'cancelado'
    ];

    protected $dates = [
        'created_at'
    ];

    public function turno() {
        return $this->belongsTo(Turno::class, 'turno_id');
    }
    public function alumno() {
        return $this->belongsTo(Usuario::class, 'alumno_id');
    }
    public function estado() {
        if ($this->cancelado === 1) {
            return 'Cancelada';
        }
        if ($this->turno->fecha_hora >= date('Y-m-d H:i:s') ) {
            return 'Futuras';
        } else {
            return 'Pasadas';
        }
    }
    public function puedeCancelar() {
        return (($this->turno->fecha_hora->diffInDays(Carbon::now()) >= 2) && ($this->estado() === 'Futuras'));

    }
    public function puedeImprimir() {
        return (($this->estado() === 'Futuras'));

    }
}
