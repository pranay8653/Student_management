<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $password ,$dept_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password, $dept_name)
    {
        $this->user = $user;
        $this->password = $password;
        $this->dept_name = $dept_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Registration Mail',
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
            view: 'mails.registertion_mail',
            with: [
                'user'  => $this->user,
                'password' => $this->password,
                'dept_name' => $this->dept_name,
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
