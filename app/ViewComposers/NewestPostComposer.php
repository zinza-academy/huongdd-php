<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class NewestPostComposer {
    protected $newestPosts;

    public function __construct(PostRepository $repo) {
        $this->newestPosts = Cache::remember('newestPosts', Config::get('constants.CACHE_LIFETIME'),
            function () use ($repo) {
                return $repo->getNewestPost(Config::get('constants.LIMIT_RECORD'))->load('user');
            }
        );
    }

    public function compose(View $view) {
        $view->with('newestPosts', $this->newestPosts);
    }
}
