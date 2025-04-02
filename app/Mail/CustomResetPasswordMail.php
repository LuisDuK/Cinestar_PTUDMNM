<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Đặt lại mật khẩu của bạn')
                    ->view('mails.reset_password')
                    ->with([
                        'url' => url('/reset-password?token=' . $this->token . '&email=' . $this->email),
                    ]);
    }
}