<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IncidenceNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $corrida;
    public $notificationData;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $corrida, $notificationData)
    {
        $this->user = $user;
        $this->corrida = $corrida;
        $this->notificationData = $notificationData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación sobre tu viaje',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.incidence-notification',
            with: [
                'user' => $this->user,
                'corrida' => $this->corrida,
                'notification' => $this->notificationData
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}