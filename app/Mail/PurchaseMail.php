<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $plan;
    public $billingEnds;

    public function __construct($plan, $billingEnds)
    {
        $this -> plan = $plan;
        $this -> billingEnds = $billingEnds;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for purchase the LaravelPortal!',
        );
    }

    /**
     * 뷰와 연동
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.notify',
        );
    }

    /**
     * 첨부파일을 보낼떄 이용
     * 
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        return [];
    }
}
