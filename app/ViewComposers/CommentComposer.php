<?php

namespace App\ViewComposers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class CommentComposer {
    protected $data;

    public function __construct($post_id) {
        $this->data = Cache::remember("post-$post_id-comment", Config::get('constants.CACHE_LIFETIME'), function () use ($post_id) {
            $post = Post::findOrFail($post_id);
            $records = $post->comment()->with(['user.company', 'like', 'post'])->paginate(Config::get('constants.PER_PAGE'));
            return $records;
        });
    }

    public function compose() {
        View::composer('components.comment-block', function ($view) {
            return $view->with(['comments' => $this->data, 'user' => Auth::user()]);
        });
    }
}
