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

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $messageBody)
    {
        $this->name = $name;
        $this->messageBody = $messageBody;
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
        return $this->subject('Notificación Importante')
                ->view('emails.notification')
                ->with([
                    'name' => $this->name,
                    'messageBody' => $this->messageBody,
                    'companyName' => 'ADO'
                ]);
    }
}