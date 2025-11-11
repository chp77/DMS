<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationToManageCMS extends Mailable
{
    public $recipient;
    public $sender;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $sender, $password)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to AMS')
            ->view('emails.manageCMS');
    }
}
