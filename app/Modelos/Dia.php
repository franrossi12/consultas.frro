<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table = "dias";

    protected $fillable = [
        'id',
        'descripcion',
        'numero'
    ];
}
