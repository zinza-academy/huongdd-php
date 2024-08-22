<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateUserMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $username, $password;
    /**
     * Create a new message instance.
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return $this.
     */
    public function build()
    {
        return $this->markdown('mails.create-user')
        ->subject("Your account has been created")
        ->with(['username' => $this->username,
                'password' => $this->password
            ]);
    }
}
