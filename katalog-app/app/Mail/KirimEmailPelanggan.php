<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimEmailPelanggan extends Mailable
{
    use Queueable, SerializesModels;

    public string $namaPenerima;
    public string $subjekEmail;
    public string $pesanEmail;

    public function __construct(string $namaPenerima, string $subjekEmail, string $pesanEmail)
    {
        $this->namaPenerima = $namaPenerima;
        $this->subjekEmail  = $subjekEmail;
        $this->pesanEmail   = $pesanEmail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subjekEmail);
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.pelanggan');
    }

    public function attachments(): array
    {
        return [];
    }
}
