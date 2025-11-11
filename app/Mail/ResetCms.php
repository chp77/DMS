<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetCms extends Mailable
{
    public $otp;
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp, $username)
    {
        $this->otp = $otp;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('CMS OTP verification')
            ->view('auth.passwords.resetCMSApp');
    }
}
