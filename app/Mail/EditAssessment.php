<?php

namespace App\Mail;

use App\Models\assessment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EditAssessment extends Mailable
{
    use Queueable, SerializesModels;

    public Assessment $assessment;

    public function __construct(assessment $assessment)
    {
        $this->assessment = $assessment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Edit Assessment',
        );
    }

    public function build()
    {
        return $this->subject('Assessment Updated and Published')
                    ->view('emails.edit_assessment') // Specify the view
                    ->with([
                        'assessment' => $this->assessment,
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
