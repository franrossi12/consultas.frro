<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DiaSinClase extends Model
{
    protected $table = "dias";

    protected $fillable = [
        'id',
        'descripcion',
        'fecha_desde',
        'fecha_hasta'
    ];

}
