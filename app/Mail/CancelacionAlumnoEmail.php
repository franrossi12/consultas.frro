<?php

namespace App\Mail;

use App\Modelos\Turno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelacionAlumnoEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $turno;

    /**
     * Create a new message instance.
     *
     * @param Turno $turno
     */
    public function __construct(Turno $turno)
    {
        $this->turno = $turno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Consulta Cancelada')
                    ->view('emails.cancelacion-alumno')
                    ->with(['turno' => $this->turno]);
    }
}
