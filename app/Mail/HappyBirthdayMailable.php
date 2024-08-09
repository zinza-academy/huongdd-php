<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class HappyBirthdayMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $today;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->today = Carbon::today()->format('M-d');
    }

    /**
     * @return $this.
     */
    public function build()
    {
        return $this->markdown('mails.birthday')
        ->subject("Happy birthday to you")
        ->with([
                'user' => $this->user,
                'today' => $this->today
            ]);
    }
}
