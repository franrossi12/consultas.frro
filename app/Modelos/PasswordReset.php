<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PasswordReset extends Model
{
    use Notifiable;

    protected $table = "password_resets";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token'
    ];
}
