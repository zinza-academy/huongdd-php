<?php

namespace App\Observers;

use App\Models\Topic;
use Illuminate\Support\Str;

class TopicObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(Topic $topic): void
    {
        $topic->slug = Str::slug($topic->name, '-');
    }


    /**
     * Handle the Topic "updating" event.
     */
    public function updating(Topic $topic): void
    {
        $topic->slug = Str::slug($topic->name, '-');
    }
}
