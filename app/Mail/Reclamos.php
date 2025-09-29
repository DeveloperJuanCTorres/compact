<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reclamos extends Mailable
{
    use Queueable, SerializesModels;
    public $reclamo;
    
    public function __construct($mensaje)
    {
        $this->reclamo = $mensaje;
    }

    public function build()
    {
        return $this->view('email.reclamos');
    }
}
