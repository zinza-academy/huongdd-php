<?php

namespace App\Observers;

use App\Jobs\SendMail;
use App\Mail\DelPostMailable;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if(Auth::user()->id !== $post->user->id) {
            dispatch(new SendMail($post->user->email, new DelPostMailable($post)));
        }
    }

}
