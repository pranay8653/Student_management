<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentModifyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $student_id, $dept_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student_id,$dept_name)
    {
        $this->student_id  = $student_id;
        $this->dept_name  = $dept_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Admin Modify Student Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'Mails.StudentModifyMail',
            with:   [
                'student_id'    => $this->student_id,
                'dept_name'     => $this->dept_name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
