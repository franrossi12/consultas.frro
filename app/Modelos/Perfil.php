<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = "perfiles";

    protected $fillable = [
        'id',
        'tag',
        'descripcion'
    ];
}
