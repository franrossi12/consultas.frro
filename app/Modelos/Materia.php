<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = "materias";

    protected $fillable = [
        'id',
        'descripcion',
        'carrera_id'
    ];
}
