<?php

namespace App\ViewComposers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class PostDetailComposer {
    protected $data;

    public function __construct($id) {
        $this->data = Cache::remember("post-detail-$id", Config::get('constants.CACHE_LIFETIME'), function () use ($id) {
            $record = Post::findOrFail($id);
            $record->load(['user.company', 'tag', 'comment.like']);
            return $record;
        });
    }

    public function compose() {
        View::composer('components.post-block', function ($view) {
            return $view->with('post', $this->data);
        });
    }
}
