<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contactanos extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $filePath;
    
    public function __construct($data, $filePath = null)
    {
        $this->data = $data;
        $this->filePath = $filePath;
    }

    public function build()
    {
        $email = $this->view('email.contactanos')
                ->subject($this->data['subject'] ?? 'Nuevo mensaje de Contáctanos') // Asunto dinámico
                ->from(config('mail.from.address'), config('mail.from.name'));     // remitente seguro

        if ($this->filePath && file_exists(storage_path('app/public/' . $this->filePath))) {
            $email->attach(storage_path('app/public/' . $this->filePath));
        }

        return $email;
    }
}
