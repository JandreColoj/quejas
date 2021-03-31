<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Bienvenida extends Mailable{

    use Queueable, SerializesModels;
    public $DatosEmail;

    public function __construct($DatosEmail){
        $this->DatosEmail = $DatosEmail;
    }

    public function build(){

        return $this->view('emails.bienvenida')
                    ->from('registro@pagalocard.com','Pagalo')
                    ->subject('Bienvenido-'.$this->DatosEmail->nombre);
    }
}
