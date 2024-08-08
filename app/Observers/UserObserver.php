<?php

namespace App\Observers;

use App\Jobs\SendMail;
use App\Mail\CreateUserMailable;
use App\Mail\UpdateUserMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        dispatch(new SendMail($user->email, new CreateUserMailable($user)));
    }

    /**
     * Handle the User "updating" event.
     */
    public function updated(User $user): void
    {
        dispatch(new SendMail($user->email, new UpdateUserMailable()));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

}
