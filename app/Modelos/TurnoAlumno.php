<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TurnoAlumno extends Model
{
    protected $table = "turnos_alumnos";


    protected $fillable = [
        'id',
        'turno_id',
        'alumno_id',
        'hora',
        'notificado'
    ];

    public function turno() {
        return $this->belongsTo(Turno::class, 'turno_id');
    }
    public function alumno() {
        return $this->belongsTo(Usuario::class, 'alumno_id');
    }
}
