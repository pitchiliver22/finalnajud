<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendingPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;
    public $fee_type;

    /**
     * Create a new message instance.
     */
    public function __construct(array $userData, $amount, $fee_type)
    {
        $this->user = (object) $userData;
        $this->amount = $amount;
        $this->fee_type = $fee_type;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pending Payment',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    public function build()
    {
        return $this->view('emails.pendingpayment')
            ->with([
                'user' => $this->user,
                'amount' => $this->amount,
                'fee_type' => $this->fee_type,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
