<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormularioMail extends Mailable
{
    public $full_name;
    public $payment_method;
    public $payment_status;
    public function __construct($full_name, $payment_method, $payment_status)
    {
        $this->payment_method = $payment_method;
        $this->payment_status = $payment_status;
        $this->full_name = $full_name;
    }

    public function build()
    {
        if ($this->payment_method == 'mercado_pago' && $this->payment_status == 'approved') {
            return $this
            ->subject('Gracias por completar el formulario y realizar el pago')
            ->view('emails.emailmercado');

        } else if ($this->payment_method == 'cash' && $this->payment_status == 'pending') {
            return $this
            ->subject('Gracias por completar el formulario')
            ->view('emails.emailcode');
        }
    }
}