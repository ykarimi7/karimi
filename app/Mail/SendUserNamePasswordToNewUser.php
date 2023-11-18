<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserNamePasswordToNewUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $email;
    protected $userName;
    protected $password;

    public function __construct($email, $userName, $password)
    {
        $this->email = $email;
        $this->userName = $userName;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.new-user-create')
            ->with([
                'username' => $this->userName,
                'password' => $this->password,
            ])
            ->subject('Tebrikler, hesabınız oluşturuldu')
            ->to($this->email);
    }
}