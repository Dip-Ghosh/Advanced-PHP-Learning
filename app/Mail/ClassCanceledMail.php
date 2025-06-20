<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClassCanceledMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public array $details)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sorry Class was canceled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.class-canceled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
