<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncargosEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $encargo;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encargo)
    {
        $this->encargo = $encargo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.encargos');
    }
}
