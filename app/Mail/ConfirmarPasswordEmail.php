<?php

namespace App\Mail;

use App\Modelos\Usuario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmarPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $usuario;
    /**
     * Create a new message instance.
     *
     * @param Usuario $user
     */
    public function __construct(Usuario $user)
    {
        $this->usuario = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de Contraseña')
            ->view('emails.confirmation-password')
            ->with(['usuario' => $this->usuario]);
    }
}
