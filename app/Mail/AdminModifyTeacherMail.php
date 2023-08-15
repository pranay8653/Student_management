<?php

namespace App\Mail;

use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminModifyTeacherMail extends Mailable
{
    use Queueable, SerializesModels;
    public $teacher_id, $dept_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Teacher $teacher_id, $dept_name)
    {
        $this->teacher_id  = $teacher_id;
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
            subject: 'Admin Modify Teacher Mail',
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
            view: 'Mails.AdminModifyTeacherMail',
            with:   [
                'teacher_id'    => $this->teacher_id,
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
