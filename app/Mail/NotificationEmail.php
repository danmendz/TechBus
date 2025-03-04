<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $messageBody;
    public $companyName;
    public $pdfPath;
    
    /**
     * Create a new message instance.
     */
    public function __construct($name, $messageBody, $pdfPath = null)
    {
        $this->name = $name;
        $this->messageBody = $messageBody;
        $this->companyName = 'ADO';
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación Importante'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notifications'
        );
    }

    public function build()
    {
        $email = $this->subject('Notificación Importante')
            ->view('emails.notification')
            ->with([
                'name' => $this->name,
                'messageBody' => $this->messageBody,
                'companyName' => $this->companyName,
            ]);

        // Adjuntar el PDF si existe
        if ($this->pdfPath) {
            $email->attach($this->pdfPath, [
                'as' => 'ticket.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}