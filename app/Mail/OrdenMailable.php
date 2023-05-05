<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdenMailable extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $subject;
    private $data;
    public $subject;

    public function __construct($data, $subject)
    {
        //
        $this->data = $data; 
        $this->subject = $subject;
        
    }

    // public $subject = "LolStore - Aviso de pago compra rápida #";

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->view('emails.mail-orden',[ 'data' => $this->data])->subject($this->subject);
    }
}
