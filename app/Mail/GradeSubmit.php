<?php

namespace App\Mail;

use App\Models\assign; 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class GradeSubmit extends Mailable
{
    use Queueable, SerializesModels;

    public $assignments; // Hold the collection of assignments
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($assignments)
    {
        $this->user = Auth::user();

        $this->assignments = $assignments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Grade Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Grade Submitted')
                    ->view('emails.gradesubmit') 
                    ->with([
                        'assignments' => $this->assignments, 
                        'user' => $this->user,
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