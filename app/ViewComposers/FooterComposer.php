<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\TopicRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class FooterComposer {
    protected $topics, $repository;

    public function __construct(TopicRepository $repo) {
        $this->repository = $repo;
        $this->topics = Cache::remember('topics', Config::get('constants.CACHE_LIFETIME'), function () {
            return $this->repository->getAll(false);
        });
    }

    public function compose(View $view) {
        $view->with('topics', $this->topics);
    }
}
