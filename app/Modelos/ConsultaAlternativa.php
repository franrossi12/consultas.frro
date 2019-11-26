<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ConsultaAlternativa extends Model
{
    protected $table = "consultas_alternativas";

    protected $fillable = [
        'id',
        'materia_id',
        'profesor_id',
        'fecha_hora'
    ];
    public function materia() {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function profesor() {
        return $this->belongsTo(Usuario::class, 'profesor_id');
    }
}
