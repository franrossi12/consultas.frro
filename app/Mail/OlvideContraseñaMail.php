<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OlvideContraseñaMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $nombre;
    protected $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $token)
    {
        $this->token = $token;
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgot-password')->with(['token' => $this->token, 'nombre' => $this->nombre]);
    }
}
